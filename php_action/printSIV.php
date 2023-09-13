<?php 	

require_once 'core.php';
$siv_id;

$username;
if(isset($_SESSION['userName'])){
	$username = $_SESSION['userName'];
}

$srId = $_POST['srId'];

	$srSql="SELECT sr_id, siv_id FROM store_issuance_voucher WHERE sr_id={$srId}";
	$result = $connect->query($srSql);
	
	if($result->num_rows > 0) {
		$row = $result->fetch_array();
		$siv_id=$row['siv_id'];
	}else {		
		
		$sivSql="INSERT INTO store_issuance_voucher(sr_id, date_issued, date_added, added_by, SIV_status) VALUES('$srId', NOW(), NOW(), '$username', 1)";
		
		if($connect->query($sivSql) === true) {
			$siv_id = $connect->insert_id;
		}
	}
$sql = "SELECT sr.sr_id, sr.sales_id, s.sales_date, sd.sales_item_id, sd.selling_price, sd.selling_quantity, p.product_id, p.part_no, p.description FROM (((store_requisition AS sr INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) INNER JOIN sales_detail AS sd ON s.sales_id = sd.sales_id) INNER JOIN product AS p ON sd.product_id = p.product_id) WHERE sr.sr_id = $srId";

$sivResult = $connect->query($sql);
$sivData = $sivResult->fetch_array();

$sr_id = $sivData[0];
$sales_id = $sivData[1];
$sales_date = $sivData[2];


$table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5" align="Left">

				Sales Date : '.$sales_date.'</br>
				SIV ID : '.$siv_id.'</br>
				Sales ID : '.$sales_id.'</br>
				SR ID : '.$sr_id.' 		
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

		$sql = "SELECT sr.sr_id, sr.sales_id, s.sales_date, sd.sales_item_id, sd.selling_price, sd.selling_quantity, p.product_id, p.part_no, p.description FROM (((store_requisition AS sr INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) INNER JOIN sales_detail AS sd ON s.sales_id = sd.sales_id) INNER JOIN product AS p ON sd.product_id = p.product_id) WHERE sr.sr_id = $srId";

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
</table>
 ';


$connect->close();

echo $table;