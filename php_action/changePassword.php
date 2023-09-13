<?php 

require_once 'core.php';

//$salt = md5('$2y$Ethiopia$2y$');

function encrypt($pass){
		$pass = htmlspecialchars(trim(stripslashes($pass)));
		$pass = $pass.md5('$2y$Ethiopia$2y$');
		$pass = hash('sha256', $pass);
		return $pass;
	}
	
if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = encrypt($_POST['password']);
	$newPassword = encrypt($_POST['npassword']);
	$conformPassword = encrypt($_POST['cpassword']);
	$userId = $_POST['user_id'];

	
	
	$sql ="SELECT * FROM user WHERE user_id = {$userId}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
    $result = $result['Password'];
	
	if($currentPassword == $result) {

		
		if($newPassword == $result){
			$valid['success'] = false;
			$valid['messages'] = "Can not use the current password again";
		}else if($newPassword == $conformPassword) {

			$updateSql = "UPDATE user SET password = '$newPassword' WHERE user_id = {$userId}";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		}else{
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Conform password";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Current password is incorrect";
	}

	$connect->close();

	echo json_encode($valid);
}

?>