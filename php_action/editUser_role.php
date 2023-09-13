<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$user_roleName = $_POST['editUser_roleName'];
	$user_roleStatus = $_POST['editUser_roleStatus']; 
	$user_roleId = $_POST['user_roleId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE user_role SET user_role = '$user_roleName', Date_updated = NOW(), updated_by = '$username', user_role_active = '$user_roleStatus' WHERE user_role_id = '$user_roleId'";
	
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