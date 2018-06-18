<?php
	
	
$myFile2 = "/var/www/html/wlan.txt";
$myFileLink2 = fopen($myFile2, 'w+') or die("Impossibile scrivere su file.");
$newContents = $_GET["wlan"];
fwrite($myFileLink2, $newContents);
fclose($myFileLink2);	
	

?>