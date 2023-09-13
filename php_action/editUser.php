<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$firstName = $_POST['editUserFirstname'];
	$lastName = $_POST['editUserLastname'];
	$userName = $_POST['editUserName'];
	$userEmail = $_POST['editUserEmail'];
	$userRole = $_POST['editUserRole'];	
	$userStatus = $_POST['editUserStatus'];
	$userId = $_POST['userId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE user SET user_name = '$userName', first_name = '$firstName', last_name = '$lastName', email = '$userEmail', user_Role_id = '$userRole', Date_updated = NOW(), updated_by = '$username', user_active = '$userStatus' WHERE user_id = '$userId'";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		echo$firstName;
		die($sql);
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST