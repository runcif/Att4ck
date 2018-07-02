<?php 
session_start(); 
include("../auth/menu.php");	

if(!isset($_SESSION["wlan"]))
{
?>		 <center><td style="text-align: center;">Ricerca e attiva l'interfaccia wireless prima!!!</td></center>
<?php
}
else
{
	include("../auth/connect.php");
	
	exec("sudo timeout --foreground 5 airodump-ng -w /var/www/html/my --output-format csv --write-interval 1 ".$_SESSION["wlan"]. "",  $output, $code);
     
    if($output>0) {
     exec("sudo /var/www/html/tools/converti",$output,$code);

$mac = array();
$myfile = fopen("/var/www/html/out.csv", "r") or die("Non riesco a vedere nessun drone!");
// Output one character until end-of-file
while(!feof($myfile)) {

		   $mac[] = fgets($myfile); 

}
fclose($myfile);  
}


for ($i = 0, $n = count($mac) ; $i < $n-1; $i++)	
	{	 
	
			
    $findme = 'BSSID';
    $findme2 = 'Station MAC';

    $pos = strpos($mac[$i], $findme);
    $pos2 = strpos($mac[$i], $findme2);

   
  if($pos !== false)  
    {
      unset($mac[$i]);	
      array_splice( $mac , $i, 0, '<img src="../images/dronecerca.png" title="Droni" width="50"><br><span style="color:#800000;text-align:center;">Possibili Droni</span>');
      $save_i = $i;
	} 
  else if($pos2 !== false)  
 { 
      unset($mac[$i]);	
      array_splice( $mac , $i, 0, '<img src="../images/telecomando.png" title="Piloti" width="50"><br><span style="color:#800000;text-align:center;">Possibili Piloti</span>');
      $save_i2 = $i;
}


   ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	<form action="seleziona_mac.php" method="POST">
    
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
	 	if($res["vendor"] !== null ) 
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
<?php
	
	
}


}


} 
	
  


}

include("../auth/footer.php");
  
?>