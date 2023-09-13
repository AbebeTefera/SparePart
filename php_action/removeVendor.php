<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$vendorId = $_POST['vendorId'];

if($vendorId) { 

 $sql = "UPDATE vendor SET vendor_status = 2 WHERE vendor_id = {$vendorId}";

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