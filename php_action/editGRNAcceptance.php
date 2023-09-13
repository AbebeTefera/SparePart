<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$GRNAcceptance = $_POST['GRNAcceptance'];
	$note = $_POST['note'];
	$grnId = $_POST['grnId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE goods_receiving_note SET grn_acceptance = '$GRNAcceptance', note = '$note', Date_Acceptance = NOW(), Acceptance_by = '$username' WHERE grn_id = '$grnId'";
	
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