<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$purchaseId = $_POST['purchaseId'];

if($purchaseId) { 

 $sql = "UPDATE purchase SET purchase_status = 2 WHERE purchase_id = {$purchaseId}";

 $purchaseItem = "UPDATE purchase_detail SET purchase_item_status = 2 WHERE  purchase_id = {$purchaseId}";

 if($connect->query($sql) === TRUE && $connect->query($purchaseItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the purchase";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST