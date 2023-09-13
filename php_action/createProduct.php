<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $partNo 			= $_POST['partNo'];
  $description 		= $_POST['description'];
  $model 			= $_POST['model'];
  $brandName 		= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $unit 			= $_POST['unit'];
  $shelfNo 			= $_POST['shelfNo'];
  $criticalLimit	= $_POST['criticalLimit'];
  $productStatus 	= $_POST['productStatus'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$username;
				if(isset($_SESSION['userName'])){
				$username = $_SESSION['userName'];
				}
				
				$sql = "INSERT INTO product (category_id, brand_id, part_no, description, model, critical_limit, stock_unit_id, shelf_id, part_image, date_added, added_by, product_active, product_status) 
				VALUES ('$categoryName','$brandName', '$partNo', '$description', '$model', '$criticalLimit', '$unit', '$shelfNo', '$url', NOW(), '$username', '$productStatus', 1)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST