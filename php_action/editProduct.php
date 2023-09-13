<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
  $productId 		= $_POST['productId'];
  $partNo 			= $_POST['editPartNo'];
  $description 		= $_POST['editDescription'];
  $model 			= $_POST['editModel'];
  $brandName 		= $_POST['editBrandName'];
  $categoryName 	= $_POST['editCategoryName'];
  $unit 			= $_POST['editUnit'];
  $shelfNo 			= $_POST['editShelfNo'];
  $criticalLimit	= $_POST['editCriticalLimit'];
  $productStatus 	= $_POST['editProductStatus'];
	
	$username;
	if(isset($_SESSION['userName'])){
		$username = $_SESSION['userName'];
	}
	
	$sql = "UPDATE product SET category_id = '$categoryName', brand_id='$brandName', part_no = '$partNo', description = '$description', model = '$model', critical_limit = '$criticalLimit', stock_unit_id = '$unit', shelf_id = '$shelfNo', product_active = '$productStatus', date_updated = NOW(), updated_by = '$username' WHERE product_id = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
