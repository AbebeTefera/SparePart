<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$salt = md5('$2y$Ethiopia$2y$');

if($_POST) {	

	$firstName = $_POST['userFirstname'];
	$lastName = $_POST['userLastname'];
	$userName = $_POST['userName'];
	$pass = htmlspecialchars(trim(stripslashes($_POST['userPassword'])));
	$userEmail = $_POST['userEmail'];
	$userRole = $_POST['userRole'];	
	$userStatus = $_POST['userStatus'];
	
	$password=$pass.$salt;
	$hashedpw=hash('sha256', $password);
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO user (user_name, password, first_name, last_name, email, user_role_id, Date_added, Added_by, user_active, user_status) VALUES ('$userName', '$hashedpw', '$firstName', '$lastName', '$userEmail', '$userRole',  NOW(),'{$username}','$userStatus', 1)";
	
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