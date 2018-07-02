<?php 
session_start(); 
include("../auth/menu.php");

if(isset($_POST['selmac']))
{
	
	$_SESSION["mac"] = $_POST['selmac'];
    
    
    //server ad impostare il mac nel database qualora il drone non venisse rilevato
    $mac_split = str_split($_POST['selmac'],8); 
	$mac3 = $mac_split[0];
    
    $_SESSION["mac3"] = $mac3;	


	?>
	<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	 
 	 <tbody>
		 	<tr>
 	         <td style="text-align: center;">Hai selezionato: <?php echo $_SESSION["mac"];?>, adesso attacca!</td>
		 	</tr>
	         </tbody>
     </table>
<?php
echo "<meta http-equiv=\"refresh\" content=\"1;URL=../index.php\">";

}
include("../auth/footer.php");
