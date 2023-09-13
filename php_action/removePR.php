<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$prId = $_POST['prId'];

if($prId) { 

 $sql = "UPDATE purchase_requisition SET PR_status = 2 WHERE PR_id = {$prId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST