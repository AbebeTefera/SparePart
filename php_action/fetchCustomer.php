<?php 	

require_once 'core.php';

$sql = "SELECT customer_id, customer_name, city, contact_name, phone, fax, email, TIN, customer_status FROM customer WHERE customer_status = 1 order by customer_id asc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 while($row = $result->fetch_array()) {
 	$customerId = $row[0];
 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editCustomerModel" onclick="editCustomers('.$customerId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeCustomers('.$customerId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 
		$row[0],
 		$row[1], 		
 		$row[2],
		$row[3],
		$row[4],
		$row[5],
		$row[6],
		$row[7],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);