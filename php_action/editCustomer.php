<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$customerName = $_POST['editCustomerName'];
	$customerCity = $_POST['editCustomerCity'];
	$customerContact = $_POST['editCustomerContact'];
	$customerPhone = $_POST['editCustomerPhone'];
	$customerFax = $_POST['editCustomerFax'];
	$customerEmail = $_POST['editCustomerEmail'];
	$customerTIN = $_POST['editCustomerTIN']; 
	$customerId = $_POST['customerId'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE customer SET customer_name = '$customerName', city = '$customerCity', contact_name = '$customerContact',  phone = '$customerPhone', fax = '$customerFax', email = '$customerEmail', TIN = '$customerTIN', Date_updated = NOW(), updated_by = '$username' WHERE customer_id = '$customerId'";
	
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