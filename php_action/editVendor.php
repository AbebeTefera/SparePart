<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$vendorName = $_POST['editVendorName'];
	$vendorCountry = $_POST['editVendorCountry'];
	$vendorCity = $_POST['editVendorCity'];
	$vendorContact = $_POST['editVendorContact'];
	$vendorPhone = $_POST['editVendorPhone'];
	$vendorFax = $_POST['editVendorFax'];
	$vendorEmail = $_POST['editVendorEmail'];
	$vendorWebsite = $_POST['editVendorWebsite']; 
	$vendorId = $_POST['vendorId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE vendor SET vendor_name = '$vendorName', country = '$vendorCountry', city= '$vendorCity', contact_name = '$vendorContact',  phone = '$vendorPhone', fax= '$vendorFax', email = '$vendorEmail', Website = '$vendorWebsite', Date_updated = NOW(), updated_by = '$username' WHERE vendor_id = '$vendorId'";
	
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