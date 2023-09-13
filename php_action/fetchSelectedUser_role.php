<?php 	

require_once 'core.php';

$user_roleId = $_POST['user_roleId'];

$sql = "SELECT user_role_id, user_role, user_role_active, user_role_status FROM user_role WHERE user_role_id = $user_roleId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);