<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$orderId = $_POST['orderId'];

  $orderDate 					= date('Y-m-d', strtotime($_POST['orderDate']));
  $customerName 				= $_POST['customerName'];
  $priceScheme 					= $_POST['priceScheme'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 					= $_POST['vatValue'];
  $totalAmountValue     		= $_POST['totalAmountValue'];
  $discountValue				= $_POST['discountValue'];
  $grandTotalValue 				= $_POST['grandTotalValue'];
  $paid 						= $_POST['paid'];
  $dueValue 					= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];

	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE sales_order SET sales_date = '$orderDate', customer_id = '$customerName', price_id = '$priceScheme', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discountValue', grand_total = '$grandTotalValue', total_payment = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', date_updated = NOW(), updated_by = '$username', sales_status = 1 WHERE sales_id = {$orderId}";	
	$connect->query($sql);
	
	// remove the sales detail data from sales detail table
	for($x = 0; $x < count($_POST['partNo']); $x++) {			
		$removeOrderSql = "DELETE FROM sales_detail WHERE sales_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for sales_detail
	
	$fetchDateRequest= "SELECT date_requested, requested_by FROM store_requisition WHERE sales_id = {$orderId}";
	$result = $connect->query($fetchDateRequest);
	
	if($result->num_rows > 0) { 
	$row = $result->fetch_array();
	$dateRequested=$row[0];
	$requestedBy=$row[1];
	}
	
	$removeSRSql = "DELETE FROM store_requisition WHERE sales_id = {$orderId}";
	$connect->query($removeSRSql);
	
	$orderItemStatus = false;
	for($x = 0; $x < count($_POST['partNo']); $x++) {
				
				// add into order_item
				$orderItemSql = "INSERT INTO sales_detail (sales_id, product_id, selling_quantity, selling_price, selling_total_amount, date_added, added_by, date_updated, updated_by, sales_item_status) 
				VALUES ('$orderId', '".$_POST['partNo'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', NOW(), '$username', NOW(), '$username',  1)"; 
				
				$connect->query($orderItemSql);		
	
				if($x == count($_POST['partNo'])) {
					$orderItemStatus = true;
				}		
	} // /for sales_detail
 
	//For editing Store Requisition
	$srSql = "INSERT INTO store_requisition (sales_id, SR_acceptance, Date_requested, requested_by, Date_updated, Updated_by, SR_status) VALUES ('$orderId', 1, '$dateRequested', '$requestedBy', NOW(), '$username', 1)" ;

	$connect->query($srSql);
	
	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);