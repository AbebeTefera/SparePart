<?php 	

require_once 'core.php';

$sql = "SELECT shelf_id, shelf_Description, shelf_status FROM shelf WHERE shelf_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$shelfId = $row[0];
 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editShelfModel" onclick="editShelfs('.$shelfId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeShelfs('.$shelfId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array(
		$shelfId,
 		$row[1], 		
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);