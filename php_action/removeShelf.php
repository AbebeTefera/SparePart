<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$shelfId = $_POST['shelfId'];

if($shelfId) { 

 $sql = "UPDATE shelf SET shelf_status = 2 WHERE shelf_id = {$shelfId}";

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