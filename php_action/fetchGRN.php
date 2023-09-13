<?php 	

require_once 'core.php';

$sql = "SELECT g.grn_id, pr.purchase_item_id, pr.product_id, p.product_id, p.part_no, pr.purchasing_quantity, g.date_requested, g.grn_acceptance, g.date_acceptance, g.purchase_item_id, g.grn_status, g.Note, pr.pr_id FROM goods_receiving_note AS g INNER JOIN purchase_detail AS pr ON pr.purchase_item_id = g.purchase_item_id INNER JOIN product AS p ON pr.product_id = p.product_id WHERE g.GRN_status = 1 order by g.grn_id desc";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeGRNs = ""; 

 while($row = $result->fetch_array()) {
 	$grnId = $row[0];
 	// Status 
 	if($row[7] == '1') {
 		// status Draft member
 		$activeGRNs = "<label class='label label-info'>Draft</label>";
 	} elseif($row[7] == '3') {
 		// Pending member
 		$activeGRNs = "<label class='label label-warning'>Pended</label>";
 	}elseif($row[7] == '2') {
 		// Accepted member
 		$activeGRNs = "<label class='label label-success'>Accepted</label>";
	}else {
 		// Rejected member
 		$activeGRNs = "<label class='label label-danger'>Rejected</label>";
		}

	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	   <!-- <li><a type="button" data-toggle="modal" data-target="#editGRNModel" onclick="editGRNAcc('.$grnId.')"> <i class="glyphicon glyphicon-edit"></i> Detail</a></li>   -->    
	  </ul>
	</div>';

 	$output['data'][] = array( 
		//GRN ID
		$row[0],
		//Request Date	
 		$row[6],
		//PR ID	
 		$row[12],
		//purchase Item ID	
 		$row[9],
		//Part No	
 		$row[4],
		//grn Quantity	
 		$row[5],
		//Acceptance Date
		$row[8],
		//Status
 		$activeGRNs,
		//Note
		$row[11],
 		//$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);