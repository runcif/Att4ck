<html>
<head>
  <title>att4ck</title>
</head>
<body>
		
<form method="post">
  <table
 style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
	    <td style="text-align: center;">Drone Recognize</td>
    </tr>
  <tr>
    <td style="text-align: center;"><button name="cerca">Start</button></td>
  </tr>
 </tbody>
  </table>
</form>
</body>
</html>

<?php 

if (isset($_POST['cerca']))
{
		
	exec("cd /usr/lib/cgi-bin && sudo iwlist wlan1 scan | iw_parse", $output, $code);
	switch($code) {
    case 0:
    echo $output;
    
     break;
   }
}
}
?>
	