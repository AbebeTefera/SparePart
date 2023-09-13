<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$shelfDescription = $_POST['editShelfDescription'];
	$shelfId = $_POST['shelfId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE shelf SET shelf_Description = '$shelfDescription', Date_updated = NOW(), updated_by = '$username' WHERE shelf_id = '$shelfId'";
	
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