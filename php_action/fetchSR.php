<?php 	

require_once 'core.php';

$sql = "SELECT sr_id, sales_id, date_requested, sr_acceptance, date_acceptance, sr_status, note FROM store_requisition WHERE SR_status = 1 order by sr_id desc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeSRs = ""; 

 while($row = $result->fetch_array()) {
 	$srId = $row[0];
 	// Status 
 	if($row[3] == '1') {
 		// status Draft member
 		$activeSRs = "<label class='label label-info'>Draft</label>";
 	} elseif($row[3] == '3') {
 		// Pending member
 		$activeSRs = "<label class='label label-warning'>Pended</label>";
 	}elseif($row[3] == '2') {
 		// Accepted member
 		$activeSRs = "<label class='label label-success'>Accepted</label>";
	}else {
 		// Rejected member
 		$activeSRs = "<label class='label label-danger'>Rejected</label>";
		}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	   <!-- <li><a type="button" data-toggle="modal" data-target="#editSRModel" onclick="editSRAcc('.$srId.')"> <i class="glyphicon glyphicon-edit"></i> Detail</a></li> -->      
	  </ul>
	</div>';

 	$output['data'][] = array( 
		//SR ID	
		$row[0],
		//Request Date	
 		$row[2],
		//sales ID	
 		$row[1],
		//Acceptance Date
		$row[4],
 		$activeSRs,
		//Note
		$row[6],
 		//$button
 		);
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);