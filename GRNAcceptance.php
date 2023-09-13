<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Goods Receiving Note</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Goods Receiving Note</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="GRNAcceptanceTable">
					<thead>
						<tr>							
							<th>GRN ID</th>
							<th>Request Date</th>
							<th>PR ID</th>
							<th>Perchase Item ID</th>
							<th>Part No.</th>
							<th>GRN Quantity</th>
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

<!-- edit grn -->
<div class="modal fade" id="editGRNModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editGRNForm" action="php_action/editGRNAcceptance.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> GRN Acceptance</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-grn-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-grn-result">
		      <div class="form-group">
	        	<label for="GRNAcceptance" class="col-sm-3 control-label">GRN Acceptance: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="GRNAcceptance" name="GRNAcceptance">
				      	<option value="">~~SELECT~~</option>
						<option value="1">Draft</option>
				      	<option value="2">Accepted</option>
				      	<option value="3">Pended</option>
						<option value="4">Rejected</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="note" class="col-sm-3 control-label">Note: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="note" placeholder="Note" name="note" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->			
		    </div>         	        
		      <!-- /edit grn result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editGRNFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editGRNBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /edit pr -->

<script src="custom/js/grnacceptance.js"></script>

<?php require_once 'includes/footer.php'; ?>