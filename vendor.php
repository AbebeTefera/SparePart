<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Vendor</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Vendor</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addVendorModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Vendor </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageVendorTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Vendor Name</th>
							<th>Country</th>
							<th>City</th>
							<th>Contact Name</th>
							<th>Phone#</th>
							<th>Fax#</th>
							<th>E-mail</th>
							<th>Website</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addVendorModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitVendorForm" action="php_action/createVendor.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Vendor</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-vendor-messages"></div>

	        <div class="form-group">
	        	<label for="vendorName" class="col-sm-3 control-label">Vendor Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorName" placeholder="Vendor Name" name="vendorName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="vendorCountry" class="col-sm-3 control-label">Country: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorCountry" placeholder="Vendor Country" name="vendorCountry" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="vendorCity" class="col-sm-3 control-label">City: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorCity" placeholder="Vendor City" name="vendorCity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="vendorContact" class="col-sm-3 control-label">Contact Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorContact" placeholder="Contact Name" name="vendorContact" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="vendorPhone" class="col-sm-3 control-label">Phone #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorPhone" placeholder="Phone #" name="vendorPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="vendorFax" class="col-sm-3 control-label">Fax #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorFax" placeholder="Fax #" name="vendorFax" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="vendorEmail" class="col-sm-3 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorEmail" placeholder="E-mail" name="vendorEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        <div class="form-group">
	        	<label for="vendorWebsite" class="col-sm-3 control-label">Website: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="vendorWebsite" placeholder="Website" name="vendorWebsite" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createVendorBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- edit vendor -->
<div class="modal fade" id="editVendorModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editVendorForm" action="php_action/editVendor.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Vendor</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-vendor-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
			</div>

		      <div class="edit-vendor-result">
			  <div class="form-group">
	        	<label for="editVendorName" class="col-sm-3 control-label">Vendor Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorName" placeholder="Vendor Name" name="editVendorName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editVendorCountry" class="col-sm-3 control-label">Country: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorCountry" placeholder="Vendor Country" name="editVendorCountry" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editVendorCity" class="col-sm-3 control-label">City: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorCity" placeholder="Vendor City" name="editVendorCity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
		      <div class="form-group">
	        	<label for="editVendorContact" class="col-sm-3 control-label">Contact Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorContact" placeholder="Contact Name" name="editVendorContact" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editVendorPhone" class="col-sm-3 control-label">Phone #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorPhone" placeholder="Phone #" name="editVendorPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editVendorFax" class="col-sm-3 control-label">Fax #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorFax" placeholder="Fax #" name="editVendorFax" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editVendorEmail" class="col-sm-3 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorEmail" placeholder="E-mail" name="editVendorEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        <div class="form-group">
	        	<label for="editVendorWebsite" class="col-sm-3 control-label">Website: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editVendorWebsite" placeholder="Website" name="editVendorWebsite" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->		
		      </div>         	        
		      <!-- /edit vendor result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editVendorFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editVendorBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
<!-- /edit vendor -->

<!-- remove vendor -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Vendor</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeVendorFooter">
        <button type="button" class="btn btn-primary" id="removeVendorBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove vendor -->

<script src="custom/js/vendor.js"></script>

<?php require_once 'includes/footer.php'; ?>