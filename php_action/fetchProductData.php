<?php 	

require_once 'core.php';

$sql = "SELECT product_id, part_no, part_image FROM product WHERE product_status = 1 AND product_active = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);