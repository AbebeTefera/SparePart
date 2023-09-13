<?php 	

require_once 'core.php';

$userId = $_POST['userId'];

$sql = "SELECT user_id, user_name, password, first_name, last_name, email, user_role_id, last_login, user_active, user_status FROM user WHERE user_id = $userId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);