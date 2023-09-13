var managePurchaseTable;

$(document).ready(function() {
$('#navReport').addClass('active');
$('#navPurchaseOutstanding').addClass('active');

		managePurchaseTable = $("#managePurchaseTable").DataTable({
			'ajax': 'php_action/fetchPurchaseOutstanding.php',
			'order': []
		});
});

