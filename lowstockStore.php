<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Low Stock</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>		
				
				<table class="table" id="manageLowstockTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>
							<th>Part No</th>
							<th>Description</th>							
							<th>Model</th>
							<th>Brand</th>
							<th>Critical Limit</th>
							<th>Available Qty</th>
							<th>Unit</th>
							<th>Shelf#</th>
							<th>Selling Price</th>
							<th>Status</th>
							<th style="width:10%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addPRModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPRForm" action="php_action/createPR.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Add PR</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-pr-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-pr-result">
				<div class="form-group">
	        	<label for="partNo" class="col-sm-3 control-label">Part No.: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="partNo" name="partNo">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT product_id, part_no product_status FROM product WHERE product_status = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	
				
			<div class="form-group">
	        	<label for="prQuantity" class="col-sm-3 control-label">PR Quantity: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="prQuantity" placeholder="prQuantity" name="prQuantity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
		      </div>         	        
		      <!-- /edit pr result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPRFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editPRBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /Add pr -->

<script src="custom/js/lowstock.js"></script>

<?php require_once 'includes/footer.php'; ?>