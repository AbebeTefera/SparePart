<?php 	

require_once 'core.php';

$customerId = $_POST['customerId'];

$sql = "SELECT customer_id, customer_name, city, contact_name, phone, fax, email, TIN, customer_status FROM customer WHERE customer_id = $customerId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);