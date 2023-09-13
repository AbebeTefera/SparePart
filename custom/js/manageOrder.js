var manageOrderTable;

$(document).ready(function() {
$('#navInvoice').addClass('active');
$('#topNavManage').addClass('active');

		manageOrderTable = $("#manageOrderTable").DataTable({
			'ajax': 'php_action/fetchManageOrder.php',
			'order': []
		});
});

// print order function
function printOrder(orderId = null) {
	if(orderId) {		
			
		$.ajax({
			url: 'php_action/printOrder.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
				mywindow.document.write('<html><head><title>Worku Andarge Auto Spare Part Imp. & Dis. PLC. Tel. +251913730691 Fax: +251111565568 </title>');        
				mywindow.document.write('</head><body>');
				mywindow.document.write('<h2><center>Sales Invoice</center></h2>');
				mywindow.document.write(response);
				mywindow.document.write('</body></html>');

				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10

				mywindow.print();
				mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function
