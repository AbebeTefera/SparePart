<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Customer</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Customer</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addCustomerModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Customer </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageCustomerTable">
					<thead>
						<tr>
							<th>ID</th>
							<th>Customer Name</th>
							<th>City</th>
							<th>Contact Name</th>
							<th>Phone#</th>
							<th>Fax#</th>
							<th>E-mail</th>
							<th>TIN</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addCustomerModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitCustomerForm" action="php_action/createCustomer.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-plus"></i> Add Customer</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-customer-messages"></div>

	        <div class="form-group">
	        	<label for="customerName" class="col-sm-3 control-label">Customer Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="customerName" placeholder="Customer Name" name="customerName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="customerCity" class="col-sm-3 control-label">City: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="customerCity" placeholder="Customer City" name="customerCity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="customerContact" class="col-sm-3 control-label">Contact Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="customerContact" placeholder="Contact Name" name="customerContact" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="customerPhone" class="col-sm-3 control-label">Phone #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="[0-9]{10,10}" class="form-control" id="customerPhone" placeholder="Phone #" name="customerPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="customerFax" class="col-sm-3 control-label">Fax #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="[0-9]{10,10}" class="form-control" id="customerFax" placeholder="Fax #" name="customerFax" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="customerEmail" class="col-sm-3 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Please insert appropriate email address" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="customerEmail" placeholder="E-mail" name="customerEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        <div class="form-group">
	        	<label for="customerTIN" class="col-sm-3 control-label">TIN: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="^[0-9]{10,10}" class="form-control" id="customerTIN" placeholder="TIN" name="customerTIN" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCustomerBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- edit customer -->
<div class="modal fade" id="editCustomerModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCustomerForm" action="php_action/editCustomer.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"> <img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Edit Customer</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-customer-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
			</div>

		      <div class="edit-customer-result">
			  <div class="form-group">
	        	<label for="editCustomerName" class="col-sm-3 control-label">Customer Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="editCustomerName" placeholder="Customer Name" name="editCustomerName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editCustomerCity" class="col-sm-3 control-label">City: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="editCustomerCity" placeholder="Customer City" name="editCustomerCity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
		      <div class="form-group">
	        	<label for="editCustomerContact" class="col-sm-3 control-label">Contact Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="editCustomerContact" placeholder="Contact Name" name="editCustomerContact" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editCustomerPhone" class="col-sm-3 control-label">Phone #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="[0-9]{10,10}" class="form-control" id="editCustomerPhone" placeholder="Phone #" name="editCustomerPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editCustomerFax" class="col-sm-3 control-label">Fax #: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="[0-9]{10,10}" class="form-control" id="editCustomerFax" placeholder="Fax #" name="editCustomerFax" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editCustomerEmail" class="col-sm-3 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editCustomerEmail" placeholder="E-mail" name="editCustomerEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        <div class="form-group">
	        	<label for="editCustomerTIN" class="col-sm-3 control-label">TIN: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input title="Enter 10 digits only!" type="text" pattern="[0-9]{10,10}" class="form-control" id="editCustomerTIN" placeholder="TIN" name="editCustomerTIN" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->		
		      </div>         	        
		      <!-- /edit customer result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCustomerFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCustomerBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
<!-- /edit customer -->

<!-- remove customer -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Remove Customer</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeCustomerFooter">
        <button type="button" class="btn btn-primary" id="removeCustomerBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove customer -->

<script src="custom/js/customer.js"></script>

<?php require_once 'includes/footer.php'; ?>