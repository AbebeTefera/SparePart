var manageSalesTable;

$(document).ready(function() {
$('#navReport').addClass('active');
$('#navSalesOutstanding').addClass('active');

		manageSalesTable = $("#manageSalesTable").DataTable({
			'ajax': 'php_action/fetchSalesOutstanding.php',
			'order': []
		});
});

