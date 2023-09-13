<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$price_schemeId = $_POST['price_schemeId'];

if($price_schemeId) { 

 $sql = "UPDATE price_scheme SET price_status = 2 WHERE price_id = {$price_schemeId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST