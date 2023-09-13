<?php 	

require_once 'core.php';

$sql = "SELECT u.user_id, u.first_name, u.last_name, u.user_name, u.email, u.user_role_id, r.user_role_id, r.user_role, u.last_login, u.user_active, u.user_status, password FROM user AS u INNER JOIN user_role AS r ON u.user_role_id = r.user_role_id  WHERE u.user_status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeUsers = ""; 

 while($row = $result->fetch_array()) {
 	$userId = $row[0];
 	// active 
 	if($row[9] == 1) {
 		// activate member
 		$activeUsers = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeUsers = "<label class='label label-danger'>Inactive</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editUserModel" onclick="editUsers('.$userId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		<li><a type="button" data-toggle="modal" data-target="#resetMemberModal" onclick="resetUsers('.$userId.')"> <i class="glyphicon glyphicon-edit"></i> Reset Password</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeUsers('.$userId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[0],
 		$row[1],
		$row[2],
		$row[3],
		$row[4],
		$row[7],
		$row[8],
		$activeUsers,
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);