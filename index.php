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
session_start();

if (isset($_POST['mode']))
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


	    break;
    }
}
else if(isset($_POST['start']))
{
	echo "".$_SESSION['wlan'];
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

  
    ?>

<table style="width: 75%; text-align: center; margin-left: auto; margin-right: auto;"
 border="0" cellpadding="2" cellspacing="2">
	<form method="post">
    
    <?php foreach ($mac as $row): 
	
	    
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
  $response = curl_exec($ch);
  $drone = "";
  if($response) {
    $drone =  $response;
  } else if ($response == '{"errors":{"detail":"Page not found"}}') {
    $drone = "Not Found";
  }
	    
    ?>
 	    

<tr>
	 <td style="text-align: center;"><?php echo $row ?></td>
	 <td style="text-align: center;"><?php echo $drone ?></td>
     <td style="text-align: center;"><button name="seleziona">Seleziona</button></td>
    </tr>
    <?php endforeach;endif; ?>
</table>
    
    <?php 
    


}
