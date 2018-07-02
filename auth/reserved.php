<?php
session_start();
//se non c'è la sessione registrata
if ($_SESSION["autorizzato"]!=1) {
include("../auth/menu.php");

  echo "<center>";
  echo "<img src='../images/shield.png' alt='Polizia di Stato' height='300' width='300'/>";
  echo "<h1>Area riservata, accesso negato.</h1>";
  echo "Per effettuare il login clicca <a href='../auth/login.php'><font color='blue'>qui</font></a>";
  die;
}
session_start();
$cod = $_SESSION['perid']; 

function get_pagechmod($perm,$str){

if(!(strpos($perm,$str) !== false))
    {       
  include("../auth/menu.php");
  echo "<center>";
  echo "<img src='../images/shield.png' alt='Polizia di Stato' height='300' width='300'/>";
  echo "<h1>Area riservata, non sei autorizzato!!</h1>";
  die;
   return true;
  }
  else
  {
      return false;
  }

}




?>