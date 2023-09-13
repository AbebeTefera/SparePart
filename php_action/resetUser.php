<?php 

require_once 'core.php';

//$salt = md5('$2y$Ethiopia$2y$');
$valid['success'] = array('success' => false, 'messages' => array());
if($_POST) { 

$userId = $_POST['userId'];

$x='Testing1';
$pass = $x.md5('$2y$Ethiopia$2y$');
$hashedpass = hash('sha256', $pass);

$sql = "UPDATE user SET password = '$hashedpass' WHERE user_id = '$userId'";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully reset password";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while reset password the user";
 }
 
 $connect->close();

 echo json_encode($valid);
 
}
?>