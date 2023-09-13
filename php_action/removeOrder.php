<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

 $sql = "UPDATE sales_order SET sales_status = 2 WHERE sales_id = {$orderId}";

 $salesItem = "UPDATE sales_detail SET sales_item_status = 2 WHERE  sales_id = {$orderId}";
 
 $storeRequsition = "UPDATE store_requsition SET SR_status = 2 WHERE  sales_id = {$orderId}";
 if($connect->query($sql) === TRUE && $connect->query($salesItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the order";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST