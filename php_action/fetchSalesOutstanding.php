<?php 	

require_once 'core.php';

$sql = "SELECT s.sales_id, s.sales_date, c.customer_name, s.grand_total, s.total_payment, s.due FROM sales_order AS s INNER JOIN customer AS c ON s.customer_id = c.customer_id WHERE s.sales_status = 1 AND s.due>0";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
 	
	$output['data'][] = array( 		
 		// sales Id
 		$row[0],
 		// sales date
 		$row[1], 
 		// customer name
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