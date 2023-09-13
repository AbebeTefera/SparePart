<?php 	

require_once 'core.php';

$srId = $_POST['srId'];

$sql = "SELECT sr_id, sales_id, sr_acceptance, Note, date_acceptance, acceptance_by, sr_status FROM store_requisition WHERE sr_id = $srId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);