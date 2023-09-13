var manageOrderTable;

$(document).ready(function() {
$('#navInvoice').addClass('active');
$('#topNavManage').addClass('active');

		manageOrderTable = $("#manageOrderTable").DataTable({
			'ajax': 'php_action/dashboardFetchOrder.php',
			'order': []
		});
});
