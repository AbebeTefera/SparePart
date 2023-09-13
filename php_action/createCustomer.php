<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$customerName = $_POST['customerName'];
	$customerCity = $_POST['customerCity'];
	$customerContact = $_POST['customerContact'];
	$customerPhone = $_POST['customerPhone'];
	$customerFax = $_POST['customerFax'];
	$customerEmail = $_POST['customerEmail'];
	$customerTIN = $_POST['customerTIN'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO customer (customer_name, city, contact_name, phone, fax, email, TIN, Date_added, Added_by, customer_status) VALUES ('$customerName', '$customerCity', '$customerContact', '$customerPhone', '$customerFax', '$customerEmail', '$customerTIN', NOW(),'{$username}', 1)";
	
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