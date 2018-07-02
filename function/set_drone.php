<?php 
session_start(); 
include("../auth/menu.php");

if(!isset($_SESSION["mac3"]))
{
?>		 <center><td style="text-align: center;">Avvia, prima, l'interfaccia wireless e poi cerca un Drone/Pilota selezionandolo!</td></center>
<?php
}
else
{
include("../auth/connect.php");
set_drone($_SESSION["mac3"],$conn);
?>		 <center><td style="text-align: center;">MAC Address selezionato come Drone ed inserito nel database!</td></center>
<?php
}

include("../auth/footer.php");
