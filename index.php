<?php 
session_start(); 
include("auth/menu.php");

if(isset($_SESSION['wlan']))
{
	$wlan = $_SESSION['wlan'];
}
else
{
	$wlan = "Nessuna";
}
if(isset($_SESSION['mac']))
{
	$mac = $_SESSION['mac'];
}
else
{
	$mac = "Nessuno";
}


?>
<head>
<link rel = "icon" href = "../icone/favicon.ico" type ="image/x-icon" />  
<link rel = "shortcut icon" href = "../icone/favicon.ico" type ="image/x-icon" />
</head>
<div class="container">
    <BR>
  <center>
   <table
 style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>
  <tr>
	 <td style="text-align: center;">Interfaccia wireless abilitata : </td>
	 <td style="text-align: center;"><?php echo '<span style="color:#ff0000;text-align:center;"> '.$wlan.'</span>'; ?></td>
  </tr>
	<tr>
   <td style="text-align: center;">Drone selezionato : </td>
	 <td style="text-align: center;"><?php echo '<span style="color:#ff0000;text-align:center;"> '.$mac.'</span>'; ?></td>	</tr>
 </tbody>
  </table>

  
  
  
   <img allign = "left" src="images/iu-2.jpeg" alt="att4ck" height="350" width="400"/>
  <h1><font  face=�Times New Roman, Times, serif�>Att4ck - L'antidrone</font></h1><br>
 
  </center>

</div>


<script>
var browser = '';
var browserVersion = 0;

if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Opera';
} else if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
    browser = 'MSIE';
} else if (/Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Netscape';
} else if (/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Chrome';
} else if (/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Safari';
    /Version[\/\s](\d+\.\d+)/.test(navigator.userAgent);
    browserVersion = new Number(RegExp.$1);
} else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
    browser = 'Firefox';
}
if(browserVersion === 0){
    browserVersion = parseFloat(new Number(RegExp.$1));
}

//if(browser!='Chrome'){
//alert("Att4ck - Si consiglia di utilizzare Google Chrome");
//}

</script>
<?php include("auth/footer.php"); ?>