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
	<td style="text-align: center;"><button name="mode">Avvia il Monitor Mode</button></td>
    <td style="text-align: center;"><button name="start">Avvia Ricerca Drone</button></td>
    <td style="text-align: center;"><button name="deuth">Distruggi il Drone</button></td>
  </tr>
 </tbody>
  </table>
</form>
</body>
</html>

<?php 

if (isset($_POST['mode']))
{
		
	exec("cd /usr/lib/cgi-bin && sudo airmon-ng | grep -Eo 'wlan[0-9]'", $output, $code);
	switch($code) {
    case 0:
    
    
    if($output>0) :
    
    ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	    
	    <tr>
        <th>Nome scheda</th>
    </tr>
    
    <?php foreach ($output as $row): ?>
    

<tr>
	        <td> <a href="<?php echo "select_wlan.php?wlan=".$row;?>"><?php echo $row;?></a><td>


    </tr>
    <?php endforeach;endif; ?>
</table>
    
    <?php 
    
     break;
   }
}
?>
	