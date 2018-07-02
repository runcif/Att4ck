<?php 
session_start(); 
include("../auth/menu.php");	


?>		 <center><td style="text-align: center;">Ho fatto il reset di tutti i moduli, ricomincia...</td></center>
<?php
	
session_destroy();
//header('Refresh: 3; url=index.php');
echo "<meta http-equiv=\"refresh\" content=\"1;URL=../index.php\">";

include("../auth/footer.php");
