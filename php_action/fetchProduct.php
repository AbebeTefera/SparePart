<?php 	

require_once 'core.php';

$sql = "SELECT p.product_id, p.part_no, p.part_image, p.brand_id, p.category_id, p.model, p.critical_limit, p.product_active, p.product_status, p.selling_price, p.description, p.shelf_id, p.stock_unit_id, b.brand_id, b.brand_name, c.category_id, c.category_name, s.shelf_id, s.shelf_description, u.stock_unit_id, u.stock_unit_description FROM product AS p INNER JOIN brand AS b ON p.brand_id = b.brand_id INNER JOIN category AS c ON p.category_id = c.category_id INNER JOIN shelf AS s ON p.shelf_id = s.shelf_id INNER JOIN stock_unit AS u ON p.stock_unit_id = u.stock_unit_id WHERE p.product_status = 1 order by p.product_id asc";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 
 
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

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button"  id="productActionBtn" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	$brand = $row[14];
	$category = $row[16];
	$stock_unit= $row[20];
	$shelf = $row[18];

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 
		// PID
 		$row[0],	
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
		//Critical Limit
		$row[6],
		// Stock_unit
 		$stock_unit,
 		// shelf 		
 		$shelf,
		//Selling Price
		$row[9],
 		// active
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);