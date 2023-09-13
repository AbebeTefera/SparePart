var manageStockbalanceTable;

$(document).ready(function() {
	// top nav bar 
	//$('#navReport').addClass('active');
	$('#navStockBalance2').addClass('active');
	// manage Low stock table
	manageStockbalanceTable = $('#manageStockbalanceTable').DataTable({
		'ajax': 'php_action/fetchStockbalance.php',
		'order': []
	});
});
