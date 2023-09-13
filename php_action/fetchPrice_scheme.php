<?php 	

require_once 'core.php';

$sql = "SELECT price_id, price_scheme, Discount_percentage, price_active, price_status FROM price_scheme WHERE price_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activePrice_scheme = ""; 

 while($row = $result->fetch_array()) {
 	$price_schemeId = $row[0];
 	// active 
 	if($row[3] == 1) {
 		// activate member
 		$activePrice_scheme = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activePrice_scheme = "<label class='label label-danger'>Inactive</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPrice_schemeModal" onclick="editPrice_schemes('.$price_schemeId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removePrice_schemes('.$price_schemeId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
		$row[2],
 		$activePrice_scheme,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);