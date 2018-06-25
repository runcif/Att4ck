<?php
$servername = "localhost";
$username = "runcif";
$password = "att4ck";
$dbname = "att4ck";

try
{
$conn =  new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

}
catch(PDOException $e)
{

      echo $e->getMessage();
    
    
}



function check_drone($mac,$conn){

$sql    = "SELECT * FROM ouiList WHERE oui = ".$mac;
 $result = $conn->prepare($sql);
        $result->execute();
   return $result; 

}




?>
