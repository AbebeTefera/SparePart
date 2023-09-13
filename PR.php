<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Perchase Requisition</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Perchase Requisition</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addPRModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add PR </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="managePRTable">
					<thead>
						<tr>							
							<th>PR ID</th>
							<th>Request Date</th>
							<th>Part No.</th>
							<th>PR Quantity</th>
							<th>Acceptance Date</th>
							<th>Status</th>
							<th>Note</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addPRModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitPRForm" action="php_action/createPR.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-plus"></i> Add PR</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-pr-messages"></div>

	        <div class="form-group">
	        	<label for="partNo" class="col-sm-3 control-label">Part No.: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="partNo" name="partNo">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT product_id, part_no, product_status FROM product WHERE product_status = 1";
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
				      <input title="Enter numbers only!" type="text" pattern="^[0-9]+" class="form-control" id="prQuantity" placeholder="PR Quantity" name="prQuantity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createPRBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- edit pr -->
<div class="modal fade" id="editPRModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPRForm" action="php_action/editPR.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Edit PR</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-pr-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-pr-result">
				<div class="form-group">
	        	<label for="editPartNo" class="col-sm-3 control-label">Part No.: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editPartNo" name="editPartNo">
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
	        	<label for="editPrQuantity" class="col-sm-3 control-label">PR Quantity: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter numbers only!" type="text" pattern="^[0-9]+" class="form-control" id="editPrQuantity" placeholder="prQuantity" name="editPrQuantity" autocomplete="off">
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
<!-- /edit pr -->

<!-- remove pr -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Remove PR</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removePRFooter">
        <button type="button" class="btn btn-primary" id="removePRBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove pr -->

<script src="custom/js/pr.js"></script>

<?php require_once 'includes/footer.php'; ?>