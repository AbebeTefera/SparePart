<?php 	

require_once 'core.php';

$sql = "SELECT pd.purchase_id, p.purchase_date, v.vendor_name, pd.pr_id, pr.part_no, pr.description, pd.purchasing_total_amount, pd.purchasing_price, pd.purchasing_quantity FROM (((purchase_detail AS pd INNER JOIN purchase AS p ON pd.purchase_id=p.purchase_id) INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id) INNER JOIN product AS pr ON pd.product_id=pr.product_id) WHERE pd.purchase_item_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
 			
	$output['data'][] = array( 		
 		// purchase Id
 		$row[0],
 		// purchase date
 		$row[1],
		// PR ID
 		$row[3],
 		// vendor name
 		$row[2],
		//Part no
		$row[4],
		//Description
		$row[5],
		//quantity
		$row[8], 
		//Price
		$row[7],
		//total amount
		$row[6],
			
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);