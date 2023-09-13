<?php 	

require_once 'core.php';

$sql = "SELECT s.sales_id, s.sub_total, s.vat, s.total_amount, p.discount_percentage, s.discount, s.grand_total, s.total_payment, s.due, s.payment_type, s.payment_status,s.sales_date FROM sales_order AS s INNER JOIN price_scheme AS p ON s.price_id = p.price_id WHERE s.sales_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());
$PaymentType="";
$PaymentStatus="";
if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
	
	// Payment_Type 
 	if($row[9] == 1) { 		
 		$paymentType = "<label class='label label-info'>Cheque</label>";
 	} else if($row[9] == 2) { 		
 		$paymentType = "<label class='label label-success'>Cash</label>";
 	} else { 		
 		$paymentType = "<label class='label label-warning'>Credit Card</label>";
 	} // /else
		
 	// Payment_Status 
 	if($row[10] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} else if($row[10] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} else { 		
 		$paymentStatus = "<label class='label label-warning'>No Payment</label>";
 	} // /else
		
	$output['data'][] = array( 		
 		// sales Id
 		$row[0],
		// sales date
 		$row[11],
 		// sub_total
 		$row[1], 
 		// vat
 		$row[2],
		//total amount
		$row[3],
		//discount %
		//$row[4],
		//discount
		$row[5],
		//grand tota
		$row[6],
		//total payment
		$row[7],
		//total balance
		$row[8], 
		// Payment_Type
		$paymentType,
		$paymentStatus,
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);