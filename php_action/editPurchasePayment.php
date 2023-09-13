<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$purchaseId 	= $_POST['purchaseId'];
	$payAmount 		= $_POST['payAmount']; 
    $paymentType 	= $_POST['paymentType'];
    $paymentStatus 	= $_POST['paymentStatus'];  
    $paidAmount     = $_POST['paidAmount'];
    $total_amount   = $_POST['total_amount'];

  $updatePaidAmount = $payAmount + $paidAmount;
  $updateDue = $total_amount - $updatePaidAmount;

	$sql = "UPDATE purchase SET total_payment = '$updatePaidAmount', balance = '$updateDue', payment_type = '$paymentType', payment_status = '$paymentStatus' WHERE purchase_id = {$purchaseId}";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	 
$connect->close();

echo json_encode($valid);
 
} // /if $_POST