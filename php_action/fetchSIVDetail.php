<?php 	

require_once 'core.php';

if(isset($_POST['srId'])) {	

$srId = $_POST['srId'];

$sql = "SELECT sr.sr_id, sr.sales_id, s.sales_date, sd.sales_item_id, sd.selling_price, sd.selling_quantity, p.product_id, p.part_no, p.description FROM (((store_requisition AS sr INNER JOIN sales_order AS s ON sr.sales_id = s.sales_id) INNER JOIN sales_detail AS sd ON s.sales_id = sd.sales_id) INNER JOIN product AS p ON sd.product_id = p.product_id) WHERE sr.sr_id = $srId order by sr.sr_id desc";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	
 	$output['data'][] = array(
		//SR ID
		$row[0],
		//sales_detail_id	
 		$row[3],
		//part no	
 		$row[7],
		//description
		$row[8],
 		//seles Price
		$row[4],
		//sales quantity
		$row[5],
 		);
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);

}