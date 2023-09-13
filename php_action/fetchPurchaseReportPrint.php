<?php 	

require_once 'core.php';

if($_POST) {
	
	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y', $startDate);
	$start_date = $date->format("Y-m-d");

	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y', $endDate);
	$end_date = $format->format("Y-m-d");
	
	$sql = "SELECT p.purchase_id, p.purchase_date, v.vendor_name, p.total_amount, p.total_payment, p.balance, p.payment_type, p.payment_status FROM purchase AS p INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id WHERE p.purchase_date >= '$start_date' AND p.purchase_date <= '$end_date' AND p.purchase_status = 1";
	
	$query = $connect->query($sql);
	
$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Purchase ID</th>
			<th>Purchase Date</th>
			<th>Vendor Name</th>
			<th>Total Amount</th>
			<th>Total Payment</th>
			<th>Balance</th>
			<th>Payment Type</th>
			<th>Payment Status</th>
		</tr>

		<tr>';
		$grandTotal = "";
		while ($result = $query->fetch_array()) {
			$table .= '<tr>
				<td><center>'.$result[0].'</center></td>
				<td><center>'.$result[1].'</center></td>
				<td><center>'.$result[2].'</center></td>
				<td><center>'.$result[3].'</center></td>
				<td><center>'.$result[4].'</center></td>
				<td><center>'.$result[5].'</center></td>
				<td><center>'.$result[6].'</center></td>
				<td><center>'.$result[7].'</center></td>
			</tr>';	
			$grandTotal += $result[3];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Grand Total</center></td>
			<td><center>'.$grandTotal.'</center></td>
		</tr>
	</table>
	';	
	//header("Contenet-Type: application/xls");
	//header("Contenet-Disposition: attachment; filename=download.xls");
	echo $table;
}
?>