var managePurchaseTable;

$(document).ready(function() {
//$('#navReport').addClass('active');
$('#navPurchaseReport').addClass('active');

		managePurchaseTable = $("#managePurchaseTable").DataTable({
			'ajax': 'php_action/fetchPurchaseReport.php',
			'order': []
		});
// order date picker
	$("#startDate").datepicker();
	// order date picker
	$("#endDate").datepicker();

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();

		if(startDate == "" || endDate == "") {
			if(startDate == "") {
				$("#startDate").closest('.form-group').addClass('has-error');
				$("#startDate").after('<p class="text-danger">The Start Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if(endDate == "") {
				$("#endDate").closest('.form-group').addClass('has-error');
				$("#endDate").after('<p class="text-danger">The End Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
				
					var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
						mywindow.document.write('<html><head><title>Purchase Report </title>');        
						mywindow.document.write('</head><body>');
						mywindow.document.write(response);
						mywindow.document.write('<br> Note: Payment Type=1 ==>Cheque, Payment Type=2 ==>Cash, Payment Type =3 ==>Credit Card <br>Payment Status=1 ==> Full Payment, Payment Status=2 ==> Advanced Payment, Payment Status=3 ==> No Payment');
						mywindow.document.write('</body></html>');
						mywindow.document.close(); // necessary for IE >= 10
						mywindow.focus(); // necessary for IE >= 10
						mywindow.print();
						mywindow.close();
						
				} // /success
			});	// /ajax

		} // /else

		return false;
	});	
});
