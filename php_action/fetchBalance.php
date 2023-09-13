<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT product_id, received_quantity, stock_balance FROM available_stock WHERE product_id = $productId order by product_id asc";
$result = $connect->query($sql);
$row="";
if($result->num_rows > 0) { 
$row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);