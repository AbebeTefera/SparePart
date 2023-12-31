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
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Stock Balance</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>		
				
				<table class="table" id="manageStockbalanceTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>
							<th>Part No</th>
							<th>Description</th>							
							<th>Model</th>
							<th>Brand</th>
							<th>Category</th>
							<th>Unit</th>
							<th>Shelf#</th>
							<th>Selling Price</th>
							<th>Rec. Qty</th>
							<th>Issued Qty</th>
							<th>Balance</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->



<script src="custom/js/stockbalance.js"></script>

<?php require_once 'includes/footer.php'; ?>