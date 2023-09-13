<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$categoryName = $_POST['categoriesName'];
	$categoryStatus = $_POST['categoriesStatus']; 

	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO category (category_name, Date_added, Added_by, category_active, category_status) 
	VALUES ('$categoryName', NOW(), '{$username}', '$categoryStatus', 1)";

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