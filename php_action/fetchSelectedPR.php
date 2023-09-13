<?php 	

require_once 'core.php';

$prId = $_POST['prId'];

$sql = "SELECT pr_id, product_id, pr_quantity, pr_acceptance, note, date_acceptance, acceptance_by, pr_status FROM purchase_requisition WHERE pr_id = $prId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);