<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = array('sales_order' => array(), 'sales_detail' => array());

$sql = "SELECT sales_id, sales_date, customer_id, sub_total, vat, total_amount, discount, grand_total, total_payment, due, payment_type, payment_status FROM sales_order WHERE sales_id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['sales_order'] = $data;


$connect->close();

echo json_encode($valid);