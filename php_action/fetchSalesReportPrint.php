<?php 	

require_once 'core.php';

if($_POST) {
	
	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y', $startDate);
	$start_date = $date->format("Y-m-d");

	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y', $endDate);
	$end_date = $format->format("Y-m-d");
	
	$sql = "SELECT s.sales_id, s.sub_total, s.vat, s.total_amount, p.discount_percentage, s.discount, s.grand_total, s.total_payment, s.due, s.payment_type, s.payment_status, s.sales_date FROM sales_order AS s INNER JOIN price_scheme AS p ON s.price_id = p.price_id WHERE s.sales_status = 1 AND s.sales_date >= '$start_date' AND s.sales_date <= '$end_date'";
	
	$query = $connect->query($sql);



$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Sales ID</th>
			<th>Sales Date</th>
			<th>Sub Total</th>
			<th>Vat</th>
			<th>Total Amount</th>
			<th>Discount %</th>
			<th>Discount</th>
			<th>Grand Total</th>
			<th>Total Payment</th>
			<th>Balance</th>
			<th>Payment Type</th>
			<th>Payment Status</th>
		</tr>

		<tr>';
		
		$subTotal = "";
		$vat = "";
		$totalAmount = "";
		$discount = "";
		$grandTotal = "";
		$totalPayment = "";
		$balance = "";
		while ($result = $query->fetch_array()) {
			
			$table .= '<tr>
				<td><center>'.$result[0].'</center></td>
				<td><center>'.$result[11].'</center></td>
				<td align="Right">'.$result[1].'</td>
				<td align="Right">'.$result[2].'</td>
				<td align="Right">'.$result[3].'</td>
				<td align="Right">'.$result[4].'</td>
				<td align="Right">'.$result[5].'</td>
				<td align="Right">'.$result[6].'</td>
				<td align="Right">'.$result[7].'</td>
				<td align="Right">'.$result[8].'</td>
				<td><center>'.$result[9].'</center></td>
				<td><center>'.$result[10].'</center></td>
			</tr>';	
			$subTotal += $result[1];
			$vat += $result[2];
			$totalAmount += $result[3];
			$discount += $result[5];
			$grandTotal += $result[6];
			$totalPayment += $result[7];
			$balance += $result[8];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="2" ><b><center>Total</center></b></td>
			<td align="Right"><b>'.$subTotal.'</b></td>
			<td align="Right"><b>'.$vat.'</b></td>
			<td align="Right"><b>'.$totalAmount.'</b></td>
			<td></td>
			<td align="Right"><b>'.$discount.'</b></td>
			<td align="Right"><b>'.$grandTotal.'</b></td>
			<td align="Right"><b>'.$totalPayment.'</b></td>
			<td align="Right"><b>'.$balance.'</b></td>
			
		</tr>
	</table>
	';	

	echo $table;
}
?>