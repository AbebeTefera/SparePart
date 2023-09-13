var manageAvailableTable;

$(document).ready(function() {
	// top nav bar 
	$('#navOrder').addClass('active');
	$('#topNavStock').addClass('active');
	// manage Low stock table
	manageAvailableTable = $('#manageAvailableTable').DataTable({
		'ajax': 'php_action/fetchAvailableStock.php',
		'order': []
	});
});

