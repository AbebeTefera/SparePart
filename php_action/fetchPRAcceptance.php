<?php 	

require_once 'core.php';

$sql = "SELECT pr.PR_id, pr.product_id, p.product_id,  p.part_no, pr.PR_quantity, pr.date_requested, pr.pr_acceptance, pr.date_acceptance, pr.PR_status, pr.Note FROM purchase_requisition AS pr INNER JOIN product AS p ON pr.product_id = p.product_id WHERE pr.PR_status = 1 order by pr.pr_id desc" ;
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activePRs = ""; 

 while($row = $result->fetch_array()) {
 	$prId = $row[0];
 	// Status 
 	if($row[6] == '1') {
 		// status Draft member
 		$activePRs = "<label class='label label-info'>Draft</label>";
 	} elseif($row[6] == '3') {
 		// Pending member
 		$activePRs = "<label class='label label-warning'>Pended</label>";
 	}elseif($row[6] == '2') {
 		// Accepted member
 		$activePRs = "<label class='label label-success'>Accepted</label>";
	}else {
 		// Rejected member
 		$activePRs = "<label class='label label-danger'>Rejected</label>";
		}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPRModel" onclick="editPRAcc('.$prId.')"> <i class="glyphicon glyphicon-edit"></i> Acceptance</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 
		//PR ID	
 		$row[0],
		//Request Date	
 		$row[5], 
		//Part No	
 		$row[3],
		//Pr Quantity	
 		$row[4],
		//Acceptance Date
		$row[7],
		//Status
 		$activePRs,
		//Note
		$row[9],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);