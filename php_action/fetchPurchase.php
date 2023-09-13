<?php 	

require_once 'core.php';

$sql = "SELECT p.purchase_id, p.purchase_date, p.vendor_id, p.payment_status, v.vendor_id, v.vendor_name, v.phone, v.email FROM purchase AS p INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id WHERE purchase_status = 1 order by p.purchase_id desc";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$purchaseId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM purchase_detail WHERE purchase_id = $purchaseId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[3] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Full Payment</label>";
 	} else if($row[3] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Advance Payment</label>";
 	} else { 		
 		$paymentStatus = "<label class='label label-warning'>No Payment</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="purchase.php?o=editPur&i='.$purchaseId.'" id="editPurchaseModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    
	    <li><a type="button" data-toggle="modal" id="paymentPurchaseModalBtn" data-target="#paymentPurchaseModal" onclick="paymentPurchase('.$purchaseId.')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>
   
	    <li><a type="button" data-toggle="modal" data-target="#removePurchaseModal" id="removePurchaseModalBtn" onclick="removePurchase('.$purchaseId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
		// purchase id
 		$row[0],
 		// purchase date
 		$row[1],
 		// vendor name
 		$row[5], 
 		// phone
 		$row[6],
		//Email
		$row[7],
 		$itemCountRow, 		 	
 		$paymentStatus,
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);