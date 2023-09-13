<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Purchase Outstanding</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Purchase Outstanding</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="managePurchaseTable">
				<thead>
					<tr>
						<th>Purchase ID</th>
						<th>Purchase Date</th>
						<th>Vendor Name</th>
						<th>Total Amount</th>
						<th>Total Payment</th>
						<th>Total Balance</th>
					</tr>
				</thead>
			</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/purchaseOutstanding.js"></script>

<?php require_once 'includes/footer.php'; ?>


	