<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add purchase
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manpur') { 
	echo "<div class='div-request div-hide'>manpur</div>";
} else if($_GET['o'] == 'editPur') { 
	echo "<div class='div-request div-hide'>editPur</div>";
} // /else manage purchase


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Purchase</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Purchase
		<?php } else if($_GET['o'] == 'manpur') { ?>
			Manage Purchase
		<?php } // /else manage purchase ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Purchase";
	} else if($_GET['o'] == 'manpur') { 
		echo "Manage Purchase";
	} else if($_GET['o'] == 'editPur') { 
		echo "Edit Purchase";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i> Add Purchase
		<?php } else if($_GET['o'] == 'manpur') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Purchase
		<?php } else if($_GET['o'] == 'editPur') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Purchase
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add purchase
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createPurchase.php" id="createPurchaseForm">

			  <div class="form-group">
			    <label for="purchaseDate" class="col-sm-2 control-label">Purchase Date: </label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="purchaseDate" name="purchaseDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  
			  <div class="form-group">
	        	<label for="vendorName" class="col-sm-2 control-label">Vendor Name: </label>
	        	   <div class="col-sm-10">
				      <select type="text" class="form-control" id="vendorName" name="vendorName" >
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT vendor_id, vendor_name, vendor_status FROM vendor WHERE vendor_status = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->
			
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  
						<th style="width:15%;">PR_ID</th>					
			  			<th style="width:25%;">Product</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 4; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">		

							<td style="padding-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="PR_id[]" id="PR_id<?php echo $x; ?>" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT PR_id, PR_acceptance FROM purchase_requisition WHERE PR_status = 1 AND PR_acceptance = 2";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[0]."</option>";
										} // while 
			  						?>
		  						</select>
			  					</div>
			  				</td>						
			  				<td style="padding-left:40px;">
			  					<div class="form-group">

			  					<select class="form-control" name="partNo[]" id="partNo<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT product_id, part_no, selling_price FROM product WHERE product_active = 1 AND product_status = 1";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['part_no']."</option>";
										 	} // /while 
			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="number" name="rate[]" id="rate<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1"/>			  							  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				</div> <!--/form-group--> 
			   	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input title="Enter degits only!" type="number" step=0.01 min=0 max=1000000000 class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Cheque</option>
				      	<option value="2">Cash</option>
				      	<option value="3">Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Full Payment</option>
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			   <!-- <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>-->

					<button type="submit" id="createPurchaseBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetPurchaseForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manpur') { 
			// manage purchase
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="managePurchaseTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Purchase ID</th>
						<th>Purchase Date</th>
						<th>Vendor Name</th>
						<th>Contact Phone</th>
						<th>E-mail</th>
						<th>Total Purchase Item</th>
						<th>Payment Status</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage purchase
		} else if($_GET['o'] == 'editPur') {
			// get purchase
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editPurchase.php" id="editPurchaseForm">

  			<?php $purchaseId = $_GET['i'];

  			$sql = "SELECT p.purchase_id, p.purchase_date, p.vendor_id, v.vendor_id, v.vendor_name, v.phone, v.email, p.total_amount, p.total_payment, p.balance, p.payment_type, p.payment_status FROM purchase AS p INNER JOIN vendor AS v ON p.vendor_id = p.vendor_id WHERE p.purchase_id = {$purchaseId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div class="form-group">
			    <label for="purchaseDate" class="col-sm-2 control-label">Purchase Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="purchaseDate" name="purchaseDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
	        	<label for="vendorName" class="col-sm-2 control-label">Vendor Name: </label>
	        	   <div class="col-sm-10">
				      <select title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="vendorName" name="vendorName" >
				      	<option value="<?php echo $data[3] ?>"><?php echo $data[4] ?></option>
				      	<?php 
				      	$sql = "SELECT vendor_id, vendor_name, vendor_status FROM vendor WHERE vendor_status = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while	
				      	?>
				      </select>
				    </div>
				</div> <!-- /form-group-->
			  
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">PR_ID</th>
						<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$purchaseItemSql = "SELECT purchase_item_id, purchase_id, PR_id, product_id, purchasing_quantity, purchasing_price, purchasing_total_amount FROM purchase_detail WHERE purchase_id = {$purchaseId}";
					$purchaseItemResult = $connect->query($purchaseItemSql);
						
						// print_r($purchaseItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($purchaseItemData); $x++) {
			  		$x = 1;
			  		while($purchaseItemData = $purchaseItemResult->fetch_array()) { 
			  			// print_r($purchaseItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">	
						
						<td style="padding-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="PR_id[]" id="PR_id<?php echo $x; ?>" >
			  						<option value="<?php echo $purchaseItemData[2]; ?>"><?php echo $purchaseItemData[2]; ?></option>
			  						<?php
			  							$productSql = "SELECT PR_id, PR_acceptance FROM purchase_requisition WHERE PR_status = 1 AND PR_acceptance = 'Accepted'";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[0]."</option>";
										} // while 
			  						?>
		  						</select>
			  					</div>
			  				</td>		  				
			  				<td style="padding-left:40px;">
			  					<div class="form-group">

			  					<select class="form-control" name="partNo[]" id="partNo<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT product_id, part_no, description, model, product_active, product_status FROM product WHERE product_status = 1";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $purchaseItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['part_no']."</option>";
										} // /while 
			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"  class="form-control" min="1" value="<?php echo $purchaseItemData['purchasing_price']; ?>" />			  					
			  						  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $purchaseItemData['purchasing_quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $purchaseItemData['purchasing_total_amount']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $purchaseItemData['purchasing_total_amount']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[7]; ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[7]; ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input title="Enter degits only!" type="number" step=0.01 min=0 max=1000000000 class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[8]; ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[9]; ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[9]; ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[10] == 1) {
				      		echo "selected";
				      	} ?> >Cheque</option>
				      	<option value="2" <?php if($data[10] == 2) {
				      		echo "selected";
				      	} ?>  >Cash</option>
				      	<option value="3" <?php if($data[10] == 3) {
				      		echo "selected";
				      	} ?> >Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[11] == 1) {
				      		echo "selected";
				      	} ?>  >Full Payment</option>
				      	<option value="2" <?php if($data[11] == 2) {
				      		echo "selected";
				      	} ?> >Advance Payment</option>
				      	<option value="3" <?php if($data[11] == 3) {
				      		echo "selected";
				      	} ?> >No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <!--<button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>-->

			    <input type="hidden" name="purchaseId" id="purchaseId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editPurchaseBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get purchase else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit purchase -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentPurchaseModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentPurchaseMessages"></div>
      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />				
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input title="Enter degits only!" type="number" step=0.01 min=0 max=1000000000 class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cheque</option>
			      	<option value="2">Cash</option>
			      	<option value="3">Credit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentPurchaseBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit purchase-->

<!-- remove purchase -->
<div class="modal fade" tabindex="-1" role="dialog" id="removePurchaseModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Remove Purchase</h4>
      </div>
      <div class="modal-body">
      	<div class="removePurchaseMessages"></div>
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-primary" id="removePurchaseBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove purchase-->


<script src="custom/js/purchase.js"></script>

<?php require_once 'includes/footer.php'; ?>


	