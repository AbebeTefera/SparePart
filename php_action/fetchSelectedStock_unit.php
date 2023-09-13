<?php 	

require_once 'core.php';

$stock_unitId = $_POST['stock_unitId'];

$sql = "SELECT stock_unit_id, stock_unit_description, stock_unit_status FROM stock_unit WHERE stock_unit_id = $stock_unitId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);