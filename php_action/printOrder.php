<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT s.sales_id, s.sales_date, c.customer_name, c.phone, c.TIN, s.sub_total, s.vat, s.total_amount, s.discount, s.grand_total, s.total_payment, s.due, s.customer_id, c.customer_id FROM sales_order AS s INNER JOIN customer AS c ON s.customer_id = c.customer_id WHERE sales_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[1];
$customerName = $orderData[2];
$phone = $orderData[3];
$TIN = $orderData[4];
$subTotal = $orderData[5];
$vat = $orderData[6];
$totalAmount = $orderData[7]; 
$discount = $orderData[8];
$grandTotal = $orderData[9];
$paid = $orderData[10];
$due = $orderData[11];


$orderItemSql = "SELECT s.product_id, s.selling_price, s.selling_quantity, s.selling_total_amount,
p.part_no, p.description FROM sales_detail AS s
	INNER JOIN product AS p ON s.product_id = p.product_id 
 WHERE s.sales_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Order Date : '.$orderDate.'
				<center>Customer Name : '.$customerName.'</center>
				Phone # : '.$phone.'
				TIN : '.$TIN.' 
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.No</th>
			<th>Part No.</th>
			<th>Description</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>';

		$x = 1;
		while($row = $orderItemResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row[4].'</th>
				<th>'.$row[5].'</th>
				<th>'.$row[1].'</th>
				<th>'.$row[2].'</th>
				<th>'.$row[3].'</th>
			</tr>
			';
		$x++;
		} // /while

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th>Sub Amount</th>
			<th>'.$subTotal.'</th>			
		</tr>

		<tr>
			<th>VAT (15%)</th>
			<th>'.$vat.'</th>			
		</tr>

		<tr>
			<th>Total Amount</th>
			<th>'.$totalAmount.'</th>			
		</tr>	

		<tr>
			<th>Discount</th>
			<th>'.$discount.'</th>			
		</tr>

		<tr>
			<th>Grand Total</th>
			<th>'.$grandTotal.'</th>			
		</tr>

		<tr>
			<th>Paid Amount</th>
			<th>'.$paid.'</th>			
		</tr>

		<tr>
			<th>Due Amount</th>
			<th>'.$due.'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;