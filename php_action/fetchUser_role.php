<?php 	

require_once 'core.php';

$sql = "SELECT user_role_id, user_role, user_role_active, user_role_status FROM user_role WHERE user_role_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeUser_roles = ""; 

 while($row = $result->fetch_array()) {
 	$user_roleId = $row[0];
 	// active 
 	if($row[2] == 1) {
 		// activate member
 		$activeUser_roles = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeUser_roles = "<label class='label label-danger'>Inactive</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editUser_roleModel" onclick="editUser_roles('.$user_roleId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeUser_roles('.$user_roleId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[0],
		$row[1], 		
 		$activeUser_roles,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);