<?php 	

require_once 'core.php';

$sql = "SELECT p.purchase_id, p.purchase_date, v.vendor_name, p.total_amount, p.total_payment, p.balance, p.payment_type, p.payment_status FROM purchase AS p INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id WHERE p.purchase_status = 1";
$result = $connect->query($sql);


$output = array('data' => array());

$PaymentType="";
$PaymentStatus="";

if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
 	// Payment_Type 
 	if($row[6] == 1) { 		
 		$paymentType = "<label class='label label-info'>Cheque</label>";
 	} else if($row[6] == 2) { 		
 		$paymentType = "<label class='label label-success'>Cash</label>";
 	} else { 		
 		$paymentType = "<label class='label label-warning'>Credit Card</label>";
 	} // /else
		
 	// Payment_Status 
 	if($row[7] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} else if($row[7] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} else { 		
 		$paymentStatus = "<label class='label label-warning'>No Payment</label>";
 	} // /else
		
	$output['data'][] = array( 		
 		// purchase Id
 		$row[0],
 		// purchase date
 		$row[1], 
 		// vendor name
 		$row[2],
		//total amount
		$row[3],
		//total payment
		$row[4],
		//total balance
		$row[5], 
		$paymentType,
		$paymentStatus,		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);