<?php 	

require_once 'core.php';

$sql = "SELECT p.product_id, p.part_no, p.part_image, p.brand_id, p.category_id, p.model, bq.stock_balance, p.product_active, p.product_status, p.selling_price, p.description, p.shelf_id, p.stock_unit_id, b.brand_id, b.brand_name, c.category_id, c.category_name, s.shelf_id, s.shelf_description, u.stock_unit_id, u.stock_unit_description, bq.received_quantity, bq.issued_quantity FROM stock_balance AS bq INNER JOIN product AS p ON bq.product_id = p.product_id INNER JOIN brand AS b ON p.brand_id = b.brand_id INNER JOIN category AS c ON p.category_id = c.category_id INNER JOIN shelf AS s ON p.shelf_id = s.shelf_id INNER JOIN stock_unit AS u ON p.stock_unit_id = u.stock_unit_id WHERE p.product_status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 
 $stock_balance="";
 $IssuedQty="";
 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[7] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

	If($row[22]==""){
		$IssuedQty = 0;
	}else{
		$IssuedQty = $row[22];
	}
	
	if($row[6] != "") {
 		// set stock_balance
 		$stock_balance=$row[6];
 	} else {
 		$stock_balance=$row[21];
 	} // /else
		
 	$brand = $row[14];
	$category = $row[16];
	$stock_unit= $row[20];
	$shelf = $row[18];

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// Part No
 		$row[1], 
 		// Description
 		$row[10],
 		// Model 
 		$row[5], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
		// Stock_unit
 		$stock_unit,
 		// shelf 		
 		$shelf,
		//Selling Price
		$row[9],
		//Received Qty
		$row[21],
		//Issued Qty
		$IssuedQty,
		//Available Stock
		$stock_balance,
	); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);