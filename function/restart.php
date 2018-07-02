<?php 
session_start(); 
include("../auth/menu.php");	


?>		 <center><td style="text-align: center;">Att4ck si sta riavviando ...</td></center>
<?php
session_destroy();
exec("sudo reboot", $output, $code);


include("../auth/footer.php");
