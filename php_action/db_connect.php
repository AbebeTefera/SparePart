<?php 	
error_reporting (E_ALL ^ E_NOTICE); 

$localhost = "localhost";
$username = "id18859024_root";
$password = "Abila_ttT123";
$dbname = "id18859024_spare_part";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Successfully connected";
}

?>