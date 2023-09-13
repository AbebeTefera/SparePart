<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$stock_unitId = $_POST['stock_unitId'];

if($stock_unitId) { 

 $sql = "UPDATE stock_unit SET stock_unit_status = 2 WHERE stock_unit_id = {$stock_unitId}";

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