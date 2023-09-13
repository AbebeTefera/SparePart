<?php 	

require_once 'core.php';

$grnId = $_POST['grnId'];

$sql = "SELECT grn_id, purchase_item_id, grn_acceptance, note, date_acceptance, acceptance_by, grn_status FROM goods_receiving_note WHERE grn_id = $grnId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);