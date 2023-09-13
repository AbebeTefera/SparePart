<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$user_roleName = $_POST['user_roleName'];
	$user_roleStatus = $_POST['user_roleStatus'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO user_role (user_role, Date_added, Added_by, user_role_active, user_role_status) VALUES ('$user_roleName', NOW(),'{$username}','$user_roleStatus', 1)";
	
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