<?php 	

require_once 'core.php';

if(isset($_POST['productId'])){
	
$productId = $_POST['productId'];

$sql = "SELECT product_id, category_id, brand_id, part_no, description, model, selling_price, critical_limit, stock_unit_id, shelf_id,  part_image, date_updated, updated_by, product_active, product_status FROM product WHERE product_id = $productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

}
$connect->close();

echo json_encode($row);