<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$stock_unitDescription = $_POST['editStock_unitDescription'];
	$stock_unitId = $_POST['stock_unitId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE stock_unit SET stock_unit_Description = '$stock_unitDescription', Date_updated = NOW(), updated_by = '$username' WHERE stock_unit_id = '$stock_unitId'";
	
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