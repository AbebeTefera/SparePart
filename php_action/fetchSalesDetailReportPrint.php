<?php 	

require_once 'core.php';

if($_POST) {
	
	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y', $startDate);
	$start_date = $date->format("Y-m-d");

	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y', $endDate);
	$end_date = $format->format("Y-m-d");
	
	$sql = "SELECT sd.sales_id, s.sales_date, c.customer_name, pr.part_no, pr.description, sd.selling_total_amount, sd.selling_price, sd.selling_quantity FROM (((sales_detail AS sd INNER JOIN sales_order AS s ON sd.sales_id=s.sales_id) INNER JOIN customer AS c ON s.customer_id = c.customer_id) INNER JOIN product AS pr ON sd.product_id=pr.product_id) WHERE s.sales_date >= '$start_date' AND s.sales_date <= '$end_date' AND sd.sales_item_status = 1"; 
	
	$query = $connect->query($sql);
	
$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Sales ID</th>
			<th>Sales Date</th>
			<th>Customer Name</th>
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
				<td>'.$result[2].'</td>
				<td>'.$result[3].'</td>
				<td>'.$result[4].'</td>				
				<td align="Right">'.$result[7].'</td>				
				<td align="Right">'.$result[6].'</td>
				<td align="Right">'.$result[5].'</td>
			</tr>';	
			$Totalqty += $result[7];
			$Totalprice += $result[6];
			$Totalamount += $result[5];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="5"><center><b>Total</b></center></td>
			<td align="Right"><b>'.$Totalqty.'</b></td>
			<td align="Right"><b>'.$Totalprice.'</b></td>
			<td align="Right"><b>'.$Totalamount.'</b></td>
		</tr>
	</table>
	';	

	echo $table;
}
?>