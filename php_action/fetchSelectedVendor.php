<?php 	

require_once 'core.php';

$vendorId = $_POST['vendorId'];

$sql = "SELECT vendor_id, vendor_name, country, city, contact_name, phone, fax, email, website, vendor_status FROM vendor WHERE vendor_id = $vendorId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);