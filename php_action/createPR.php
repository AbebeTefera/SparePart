<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$partNo = $_POST['partNo'];
	$prQuantity = $_POST['prQuantity'];
		
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO purchase_requisition (product_id, pr_quantity, Date_requested, requested_by, PR_acceptance, pr_status) VALUES ('$partNo', '$prQuantity', NOW(),'{$username}', 1, 1)";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
} // /if $_POST