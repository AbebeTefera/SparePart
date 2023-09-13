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
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Price</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
				
				<table class="table" id="managePriceTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>
							<th>Part No</th>
							<th>Description</th>							
							<th>Model</th>
							<th>Brand</th>
							<th>Category</th>
							<th>Critical Limit</th>
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

<!-- edit pr -->
<div class="modal fade" id="editPriceModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPriceForm" action="php_action/editPrice.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Manage Price</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-price-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		     <div class="form-group">
	        	<label for="editSellingPrice" class="col-sm-3 control-label">Selling Price: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter degits only!" type="number" step=0.01 min=0 max=1000000000 class="form-control" id="editSellingPrice" placeholder="Selling Price" name="editSellingPrice" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPriceFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editPriceBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /edit price -->
			
	      
<script src="custom/js/price.js"></script>

<?php require_once 'includes/footer.php'; ?>