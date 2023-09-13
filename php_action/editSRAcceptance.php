<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$SRAcceptance = $_POST['SRAcceptance'];
	$note = $_POST['note'];
	$srId = $_POST['srId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE store_requisition SET sr_acceptance = '$SRAcceptance', note = '$note', Date_Acceptance = NOW(), Acceptance_by = '$username' WHERE sr_id = '$srId'";
	
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