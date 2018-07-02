	<?php
	session_start();
	include("../auth/menu.php");	
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
if(isset($_POST['testo']))
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
	 <td style="text-align: center;">L'interfaccia Monitor [<?php echo $output[1];?>] è stata abilitata...</td>
	        </tr>  
	        <tr>
	 <td style="text-align: center;">Avvia la ricerca dei Droni nelle vicinanze!</td>
	        </tr>  
	         </tbody>
     </table>
 
<?php
$_SESSION['wlan'] = $output[1];
echo "<meta http-equiv=\"refresh\" content=\"1;URL=../index.php\">";

	    break;
    }
}


include("../auth/footer.php");
