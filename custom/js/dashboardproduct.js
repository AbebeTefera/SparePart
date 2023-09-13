var manageDashboardProductTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	$('#topNavProduct').addClass('active');
	// manage product data table
	manageDashboardProductTable = $('#manageDashboardProductTable').DataTable({
		'ajax': 'php_action/dashboardFetchProduct.php',
		'order': []
	});
});
