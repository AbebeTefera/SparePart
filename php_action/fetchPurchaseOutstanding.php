<?php 	

require_once 'core.php';

$sql = "SELECT p.purchase_id, p.purchase_date, v.vendor_name, p.total_amount, p.total_payment, p.balance FROM purchase AS p INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id WHERE p.purchase_status = 1 AND p.balance > 0";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
 	
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
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);