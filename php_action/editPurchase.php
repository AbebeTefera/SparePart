<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$purchaseId = $_POST['purchaseId'];

  $purchaseDate 				= date('Y-m-d', strtotime($_POST['purchaseDate']));
  $vendorName 					= $_POST['vendorName'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $paid 						= $_POST['paid'];
  $dueValue 					= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE purchase SET purchase_date = '$purchaseDate', vendor_id = '$vendorName', total_amount = '$subTotalValue', total_payment = '$paid', balance = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', date_updated = NOW(), updated_by = '$username', purchase_status = 1 WHERE purchase_id = {$purchaseId}";	
	$connect->query($sql);
	
	// remove the purchase detail data from purchase detail table
	for($x = 0; $x < count($_POST['partNo']); $x++) {			
		$removePurchaseSql = "DELETE FROM purchase_detail WHERE purchase_id = {$purchaseId}";
		$connect->query($removePurchaseSql);	
	} // /for purchase_detail
	
	$purchaseItemStatus = false;
	for($x = 0; $x < count($_POST['partNo']); $x++) {
				
				// add into purchase_item
				$purchaseItemSql = "INSERT INTO purchase_detail (purchase_id, product_id, PR_id, purchasing_quantity, purchasing_price, purchasing_total_amount, date_added, added_by, date_updated, updated_by, purchase_item_status) 
				VALUES ('$purchaseId', '".$_POST['partNo'][$x]."', '".$_POST['PR_id'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rate'][$x]."', '".$_POST['totalValue'][$x]."', NOW(), '$username', NOW(), '$username', 1)"; 
				
				$purchaseItemId;
					$purchaseStatus = false;
					if($connect->query($purchaseItemSql) === true) {
						$purchaseItemId = $connect->insert_id;
						$purchaseStatus = true;
					}
				
				$purchaseItemSql2 = "INSERT INTO goods_receiving_note (purchase_Item_id, GRN_acceptance, Date_requested, requested_by, GRN_status) VALUES ('$purchaseItemId', 1, NOW(), '$username', 1)" ;

				$connect->query($purchaseItemSql2);
				
				if($x == count($_POST['partNo'])) {
					$purchaseItemStatus = true;
				}		
	} // /for purchase_detail
	
	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated and GRN Successfully Sent";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);