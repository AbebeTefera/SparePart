<?php 	

require_once 'core.php';

$sql = "SELECT siv.siv_id, siv.date_issued, sr.sr_id, sr.sales_id, s.sales_date FROM (( store_requisition AS sr INNER JOIN  store_issuance_voucher AS siv ON  sr.sr_id = siv.sr_id ) INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) WHERE siv_status=1 order by siv.siv_id desc";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$sivId = $row[0];
 	$srId = $row[2];	
	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  <!--<li><a type="button" data-toggle="modal" data-target="#editSIVModel" onclick="editSIVAcc('.$srId.')"> <i class="glyphicon glyphicon-edit"></i> Detail</a></li>-->
	  <li><a type="button" onclick="printGatepass('.$sivId.')"> <i class="glyphicon glyphicon-edit"></i> Print Gate Pass</a></li>
	 </ul>
	</div>';
 	
 	$output['data'][] = array( 
		//SIV ID	
 		$row[0],
		//SR ID	
 		$row[2],
		//Sales ID	
 		$row[3],
		//Sales Date	
 		$row[4],
		//Issued Date
		$row[1],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);