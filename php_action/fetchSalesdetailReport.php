<?php 	

require_once 'core.php';

$sql = "SELECT sd.sales_id, s.sales_date, c.customer_name, pr.part_no, pr.description, sd.selling_total_amount, sd.selling_price, sd.selling_quantity FROM (((sales_detail AS sd INNER JOIN sales_order AS s ON sd.sales_id=s.sales_id) INNER JOIN customer AS c ON s.customer_id = c.customer_id) INNER JOIN product AS pr ON sd.product_id=pr.product_id) WHERE sd.sales_item_status = 1";
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
		//Part no
		$row[3],
		//Description
		$row[4],
		//quantity
		$row[7], 
		//Price
		$row[6],
		//total amount
		$row[5],
			
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);