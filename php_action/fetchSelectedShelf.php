<?php 	

require_once 'core.php';

$shelfId = $_POST['shelfId'];

$sql = "SELECT shelf_id, shelf_description, shelf_status FROM shelf WHERE shelf_id = $shelfId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);