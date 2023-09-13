<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Price Scheme</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Price Scheme</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addPrice_schemeModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Price Scheme </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="managePrice_schemeTable">
					<thead>
						<tr>							
							<th>Price Scheme</th>
							<th>Discount Percentage</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addPrice_schemeModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitPrice_schemeForm" action="php_action/createPrice_scheme.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-plus"></i> Add Price Scheme</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-price_scheme-messages"></div>

	        <div class="form-group">
	        	<label for="price_schemeName" class="col-sm-4 control-label">Price Scheme: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="price_schemeName" placeholder="Price scheme" name="price_schemeName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

			<div class="form-group">
	        	<label for="price_schemeDiscount" class="col-sm-4 control-label">Discount Percentage: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter degits only!" type="number" step=0.01 min=0 max=100 class="form-control" id="price_schemeDiscount" placeholder="Discount Percentage" name="price_schemeDiscount" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			
	        <div class="form-group">
	        	<label for="price_schemeStatus" class="col-sm-4 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="price_schemeStatus" name="price_schemeStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Active</option>
				      	<option value="2">Inactive</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createPrice_schemeBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- edit price_scheme -->
<div class="modal fade" id="editPrice_schemeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPrice_schemeForm" action="php_action/editPrice_scheme.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Edit Price Scheme</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-price_scheme-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-price_scheme-result">
		      	<div class="form-group">
		        	<label for="editPrice_schemeName" class="col-sm-4 control-label">Price Scheme: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="editPrice_schemeName" placeholder="Price Scheme" name="editPrice_schemeName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	
				
				<div class="form-group">
	        	<label for="editPrice_schemeDiscount" class="col-sm-4 control-label">Discount Percentage: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter degits only!" type="number" step=0.01 min=0 max=100 class="form-control" id="editPrice_schemeDiscount" placeholder="Discount Percentage" name="editPrice_schemeDiscount" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->
				
		        <div class="form-group">
		        	<label for="editPrice_schemeStatus" class="col-sm-4 control-label">Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editPrice_schemeStatus" name="editPrice_schemeStatus">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Active</option>
					      	<option value="2">Inactive</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->	
		      </div>         	        
		      <!-- /edit price_scheme result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPrice_schemeFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editPrice_schemeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
<!-- /edit price_scheme -->

<!-- remove price_scheme -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Remove Price Scheme</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removePrice_schemeFooter">
        <button type="button" class="btn btn-primary" id="removePrice_schemeBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove price_scheme -->

<script src="custom/js/price_scheme.js"></script>

<?php require_once 'includes/footer.php'; ?>