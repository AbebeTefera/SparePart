<?php require_once 'includes/header.php'; ?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Store Issuance Voucher</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Store Issuance Voucher</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="SIVAcceptanceTable">
					<thead>
						<tr>							
							<th>SIV ID</th>
							<th>SR ID</th>
							<th>Sales ID</th>
							<th>Sales Date</th>
							<th>Issued Date</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!-- edit pr -->
<div class="modal fade" id="editSIVModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editSIVForm" action="php_action/fetchSIVDetail.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i> Store Issuance Voucher</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-pr-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
			</div>
     
			<div class="panel panel-default">
			<div class="panel-heading">
			<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> SIV Detail</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="SIVDetailTable">
					<thead>
						<tr>							
							<th>Sales Detail ID</th>
							<th>Part No</th>
							<th>Description</th>
							<th>Seles Price</th>
							<th>Quantity</th>
						</tr>
					</thead>
					
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
			</div> <!-- /panel -->
	      </div> <!-- /modal-body -->
		  <div class="modal-footer editSIVFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editSIVBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Show Detail</button>
	      </div>
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /edit pr -->

<script src="custom/js/siv.js"></script>

<?php require_once 'includes/footer.php'; ?>