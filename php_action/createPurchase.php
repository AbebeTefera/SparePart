<?php 	

require_once 'core.php';

	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}

	$valid['success'] = array('success' => false, 'messages' => array(), 'purchase_id' => '');

if($_POST) {	
  
  $purchaseDate 				= date('Y-m-d', strtotime($_POST['purchaseDate']));	
  $vendorName 					= $_POST['vendorName'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $paid 						= $_POST['paid'];
  $dueValue 					= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

	$sql = "INSERT INTO purchase (purchase_date, vendor_id, total_amount, total_payment, balance, payment_type, payment_status, date_added, added_by, purchase_status) VALUES ('$purchaseDate', '$vendorName', '$subTotalValue', '$paid', '$dueValue', '$paymentType', '$paymentStatus', NOW(), '$username', 1)";
	
	$purchase_id;
	$purchaseStatus = false;
	if($connect->query($sql) === true) {
		$purchase_id = $connect->insert_id;
		$valid['purchase_id'] = $purchase_id;	

		$purchaseStatus = true;
	}
			
	// echo $_POST['productName'];
	$purchaseItemStatus = false;

	for($x = 0; $x < count($_POST['partNo']); $x++) {
				
				// add into purchase_item
				$purchaseItemSql = "INSERT INTO purchase_detail (purchase_id, PR_id, product_id, purchasing_quantity, purchasing_price, purchasing_total_amount, date_added, added_by, purchase_item_status) 
				VALUES ('$purchase_id','".$_POST['PR_id'][$x]."','".$_POST['partNo'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rate'][$x]."', '".$_POST['totalValue'][$x]."', NOW(), '$username',  1)";

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
	$valid['messages'] = "Successfully Added and GRN Successfully Sent";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);