<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$userId = $_POST['userId'];

if($userId) { 

 $sql = "UPDATE user SET user_status = 2 WHERE user_id = {$userId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the user";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST