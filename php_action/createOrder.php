<?php 	

require_once 'core.php';

	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}

	$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');

if($_POST) {	
  
  $orderDate 					= date('Y-m-d', strtotime($_POST['orderDate']));	
  $customerName 				= $_POST['customerName'];
  $priceScheme 					= $_POST['priceScheme'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 					= $_POST['vatValue'];
  $totalAmountValue     		= $_POST['totalAmountValue'];
  $discount 					= $_POST['discountValue'];
  $grandTotalValue 				= $_POST['grandTotalValue'];
  $paid 						= $_POST['paid'];
  $dueValue 					= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

	$sql = "INSERT INTO sales_order (sales_date, customer_id, sub_total, vat, total_amount, price_id, discount, grand_total, total_payment, due, payment_type, payment_status, date_added, added_by, sales_status) VALUES ('$orderDate', '$customerName', '$subTotalValue', '$vatValue', '$totalAmountValue', '$priceScheme', '$discount', '$grandTotalValue', '$paid', '$dueValue', '$paymentType', '$paymentStatus', NOW(), '$username', 1)";
	
	//$id = var_dump($sql->insert_id);
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}
			
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['partNo']); $x++) {
				
				// add into order_item
				$orderItemSql = "INSERT INTO sales_detail (sales_id, product_id, selling_quantity, selling_price, selling_total_amount, date_added, added_by, sales_item_status) 
				VALUES ('$order_id', '".$_POST['partNo'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', NOW(), '$username',  1)";

				$connect->query($orderItemSql);	
								
				if($x == count($_POST['partNo'])) {
					$orderItemStatus = true;
				}		
		} // /for sales_detail
		
	// For sending Store Requisition
	$srSql = "INSERT INTO store_requisition (sales_id, SR_acceptance, Date_requested, requested_by, SR_status) VALUES ('$order_id', 1, NOW(), '$username', 1)" ;

	$connect->query($srSql);
				
	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);