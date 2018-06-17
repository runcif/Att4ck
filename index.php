<html>
<head>
  <title>att4ck</title>
</head>
<body>
		
<form method="post">
  <table
 style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="2" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
	    <td style="text-align: center;">Operazione su Drone</td>
    </tr>
  <tr>
    <td style="text-align: center;"><button name="cerca">Avvia la ricerca</button></td>
  </tr>
 </tbody>
  </table>
</form>
</body>
</html>

<?php 

if (isset($_POST['cerca']))
{
		
	exec("cd /usr/lib/cgi-bin && sudo iwlist wlan0 scan | iw_parse > result.txt", $output, $code);
	switch($code) {
     case 0:

    $filename = "/var/www/html/result.txt";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    
    echo ""+$contents;
    
     break;
   }
}
}
?>
	
