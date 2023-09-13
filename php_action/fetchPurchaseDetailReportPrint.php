<?php 	

require_once 'core.php';

if($_POST) {
	
	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y', $startDate);
	$start_date = $date->format("Y-m-d");

	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y', $endDate);
	$end_date = $format->format("Y-m-d");
	
	$sql = "SELECT pd.purchase_id, p.purchase_date, v.vendor_name, pd.pr_id, pr.part_no, pr.description, pd.purchasing_total_amount, pd.purchasing_price, pd.purchasing_quantity FROM (((purchase_detail AS pd INNER JOIN purchase AS p ON pd.purchase_id=p.purchase_id) INNER JOIN vendor AS v ON p.vendor_id = v.vendor_id) INNER JOIN product AS pr ON pd.product_id=pr.product_id) WHERE p.purchase_date >= '$start_date' AND p.purchase_date <= '$end_date' AND pd.purchase_item_status = 1";
	
	$query = $connect->query($sql);
	
$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Purchase ID</th>
			<th>Purchase Date</th>
			<th>PR ID</th>
			<th>Vendor Name</th>
			<th>Part No.</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Total Amount</th>
		</tr>

		<tr>';
		$Totalqty = "";
		$Totalprice = "";
		$Totalamount = "";		
		while ($result = $query->fetch_array()) {
			$table .= '<tr>
				<td><center>'.$result[0].'</center></td>
				<td><center>'.$result[1].'</center></td>
				<td><center>'.$result[3].'</center></td>
				<td>'.$result[2].'</td>
				<td>'.$result[4].'</td>
				<td>'.$result[5].'</td>				
				<td align="Right">'.$result[8].'</td>				
				<td align="Right">'.$result[7].'</td>
				<td align="Right">'.$result[6].'</td>
			</tr>';	
			$Totalqty += $result[8];
			$Totalprice += $result[7];
			$Totalamount += $result[6];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="6"><center><b>Total</b></center></td>
			<td align="Right"><b>'.$Totalqty.'</b></td>
			<td align="Right"><b>'.$Totalprice.'</b></td>
			<td align="Right"><b>'.$Totalamount.'</b></td>
		</tr>
	</table>
	';	

	echo $table;
}
?>