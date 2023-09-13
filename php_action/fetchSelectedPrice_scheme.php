<?php 	

require_once 'core.php';

$price_schemeId = $_POST['price_schemeId'];

$sql = "SELECT price_id, Price_scheme, Discount_percentage, price_active, price_status FROM price_scheme WHERE price_id = $price_schemeId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);