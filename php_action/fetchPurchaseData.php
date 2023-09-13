<?php 	

require_once 'core.php';

$purchaseId = $_POST['purchaseId'];

$valid = array('purchase' => array(), 'purchase_detail' => array());

$sql = "SELECT purchase_id, purchase_date, vendor_id, total_amount, total_payment, balance, payment_type, payment_status FROM purchase WHERE purchase_id = {$purchaseId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['purchase'] = $data;


$connect->close();

echo json_encode($valid);