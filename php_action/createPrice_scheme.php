<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$price_schemeName = $_POST['price_schemeName'];
	$price_schemeDiscount = $_POST['price_schemeDiscount'];
	$price_schemeStatus = $_POST['price_schemeStatus'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO price_scheme (price_scheme, discount_percentage, Date_added, Added_by, price_active, price_status) VALUES ('$price_schemeName', '$price_schemeDiscount', NOW(),'{$username}','$price_schemeStatus', 1)";
	
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