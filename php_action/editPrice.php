<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
$username;
if($_POST) {	
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	$price = $_POST['editSellingPrice'];
	$productId = $_POST['productId'];
	
	$sql = "UPDATE product SET selling_price = '$price', date_updated = NOW(), updated_by = '$username' WHERE product_id = '$productId'";
	
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