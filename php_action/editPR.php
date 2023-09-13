<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$partNo = $_POST['editPartNo'];
	$prQuantity = $_POST['editPrQuantity']; 
	$prId = $_POST['prId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE purchase_requisition SET product_id = '$partNo', PR_quantity = '$prQuantity', date_updated = NOW(), updated_by = '$username' WHERE pr_id = '$prId'";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST