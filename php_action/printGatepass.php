<?php 	

require_once 'core.php';

$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}

$sivId = $_POST['sivId'];

$sql = $sql = "SELECT siv.siv_id, siv.date_issued, sr.sr_id, sr.sales_id, s.sales_date, c.customer_name FROM ((( store_requisition AS sr INNER JOIN  store_issuance_voucher AS siv ON sr.sr_id = siv.sr_id) INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) INNER JOIN customer AS c ON s.customer_id = c.customer_id) WHERE siv.siv_id = $sivId";

$sivResult = $connect->query($sql);
$sivData = $sivResult->fetch_array();

$siv_id = $sivData[0];
$sr_id = $sivData[2];
$sales_id = $sivData[3];
$date_issued = $sivData[1];
$customer_name = $sivData[5];


$table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5" align="Left">

				Date Issued: '.$date_issued.'</br>
				SIV ID : '.$siv_id.'</br>
				Sales ID : '.$sales_id.'</br>
				SR ID : '.$sr_id.'</br>
				Customer Name : '.$customer_name.'
			</th>
			<th colspan="5" align="Right">

				Issued By : '.$username.'</br></br>
					   Sign : _________________</br></br>
				Issued Date : _________________</br>
				 		
			</th>
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.No</th>
			<th>Item ID</th>
			<th>Part No.</th>
			<th>Description</th>
			<th>Sales Price</th>
			<th>Issued Quantity</th>		
		</tr>';

		$sql = "SELECT sr.sr_id, sr.sales_id, s.sales_date, sd.sales_item_id, sd.selling_price, sd.selling_quantity, p.product_id, p.part_no, p.description FROM (((( store_requisition AS sr INNER JOIN  store_issuance_voucher AS siv ON sr.sr_id = siv.sr_id) INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) INNER JOIN sales_detail AS sd ON s.sales_id = sd.sales_id) INNER JOIN product AS p ON sd.product_id = p.product_id) WHERE siv.siv_id = $sivId";

		$sivResult = $connect->query($sql);
		
		$x = 1;
		while($sivData = $sivResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$sivData[3].'</th>
				<th>'.$sivData[7].'</th>
				<th>'.$sivData[8].'</th>
				<th>'.$sivData[4].'</th>
				<th>'.$sivData[5].'</th>
			</tr>
			';
		$x++;
		} // /while
			
	'</tbody>
</table>';


$connect->close();

echo $table;