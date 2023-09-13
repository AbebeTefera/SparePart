<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$vendorName = $_POST['vendorName'];
	$vendorCountry = $_POST['vendorCountry'];
	$vendorCity = $_POST['vendorCity'];
	$vendorContact = $_POST['vendorContact'];
	$vendorPhone = $_POST['vendorPhone'];
	$vendorFax = $_POST['vendorFax'];
	$vendorEmail = $_POST['vendorEmail'];
	$vendorWebsite = $_POST['vendorWebsite'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "INSERT INTO vendor (vendor_name, Country, city, contact_name, phone, fax, email, Website, Date_added, Added_by, vendor_status) VALUES ('$vendorName', '$vendorCountry', '$vendorCity', '$vendorContact', '$vendorPhone', '$vendorFax', '$vendorEmail', '$vendorWebsite', NOW(),'{$username}', 1)";
	
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