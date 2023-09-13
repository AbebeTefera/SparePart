<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$categoryName = $_POST['editCategoriesName'];
	$categoryStatus = $_POST['editCategoriesStatus']; 
	$categoryId = $_POST['editCategoriesId'];

	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE category SET category_name = '$categoryName', Date_updated = NOW(), updated_by = '$username', category_active = '$categoryStatus' WHERE category_id = '$categoryId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST