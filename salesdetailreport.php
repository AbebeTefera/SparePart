<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
?>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Sales Detail Report</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Sales Detail Report</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal" action="php_action/fetchSalesDetailReportPrint.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
				    </div>
					<label for="endDate" class="col-sm-1 control-label">End Date</label>
				    <div class="col-sm-2">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
				    </div>
					<div class="col-sm-2">
				      <button type="submit" class="btn btn-warning" id="generateReportBtn" name="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
					</div>
					<div class="col-sm-2">
				     <!-- <button type="submit" class="btn btn-success" id="exportToExcel" name="exportToExcel"> <i class="fa fa-download"></i> Export to Excel</button>-->
				    </div>
				  </div>
				</form>
				<div class="remove-messages"></div>

				<table class="table" id="manageSalesTable">
				<thead>
					<tr>
						<th>Sales ID</th>
						<th>Sales Date</th>
						<th>Customer Name</th>
						<th>Part No.</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total Amount</th>
					</tr>
				</thead>
			</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/salesdetailReport.js"></script>

<?php require_once 'includes/footer.php'; ?>


	