<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$user_roleId = $_POST['user_roleId'];

if($user_roleId) { 

 $sql = "UPDATE user_role SET user_role_status = 2 WHERE user_role_id = {$user_roleId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the user_role";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST