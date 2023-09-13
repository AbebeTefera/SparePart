<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$price_schemeName = $_POST['editPrice_schemeName'];
	$price_schemeDiscount = $_POST['editPrice_schemeDiscount'];
	$price_schemeStatus = $_POST['editPrice_schemeStatus'];
	$price_schemeId = $_POST['price_schemeId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE price_scheme SET price_scheme = '$price_schemeName', Discount_percentage = '$price_schemeDiscount', Date_updated = NOW(), updated_by = '$username', price_active = '$price_schemeStatus' WHERE price_id = '$price_schemeId'";
	
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