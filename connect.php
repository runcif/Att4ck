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


function get_mac($conn){

$sql    = "SELECT * FROM drone";
 $result = $conn->prepare($sql);
        $result->execute();
   return $result; 


}

function set_drone($output,$conn){

$query = "INSERT INTO drone (drone_name, mac_add) VALUES
            ('$output[0]', '$output[1]')";

$result = $conn->prepare($query);
$result->execute();

}

function check_drone($mac,$conn){

$sql    = "SELECT * FROM drone WHERE mac_add = ".$mac;
 $result = $conn->prepare($sql);
        $result->execute();
   return $result; 

}




?>
