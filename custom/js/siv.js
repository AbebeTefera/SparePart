var SIVAcceptanceTable;
$(document).ready(function() {
	// top bar active
	$('#navStore').addClass('active');	
	$('#navSIV').addClass('active');
	// manage siv table
	SIVAcceptanceTable = $("#SIVAcceptanceTable").DataTable({
		'ajax': 'php_action/fetchSIV.php',
		'order': []		
	});
	// submit siv form function
});
function editSIVAcc(srId = null) {
	if(srId) {
		// remove hidden siv id text
		$('#srId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-siv-result').addClass('div-hide');
		// modal footer
		$('.editSIVFooter').addClass('div-hide');
		$(".editSIVFooter").after('<input type="hidden" name="srId" id="srId" value="'+srId+'" />');
		$.ajax({
			url: 'php_action/fetchSIVDetail.php',
			type: 'post',
			data: {srId : srId},
			dataType: 'json',
			success:function(response) {
				
			// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-siv-result').removeClass('div-hide');
				// modal footer
				$('.editSIVFooter').removeClass('div-hide');

				// setting the SIV Acceptance value 
				$('#SIVAcceptance').val(response.siv_acceptance);
				// siv id 
				$(".editSIVFooter").after('<input type="hidden" name="srId" id="srId" value="'+srId+'" />');

				// update siv form 
				$('#editSIVForm').unbind('submit').bind('submit', function(){
					
					SIVDetailTable = $("#SIVDetailTable").DataTable({
					'ajax': 'php_action/fetchSIVDetail.php',
					'order': []		
					});
					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var SIVAcceptance = $('#SIVAcceptance').val();
					
					if(SIVAcceptance == "") {
						$("#SIVAcceptance").after('<p class="text-danger">SIV Accepgance field is required</p>');

						$('#SIVAcceptance').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#SIVAcceptance").find('.text-danger').remove();
						// success out for form 
						$("#SIVAcceptance").closest('.form-group').addClass('has-success');	  	
					}

					if(SIVAcceptance) {
						var form = $(this);

						// submit btn
						$('#editSIVBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editSIVBtn').button('reset');

									// reload the manage member table 
									SIVAcceptanceTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-siv-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update siv form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /Acceptance sivs function

function printGatepass(sivId = null) {
	if(sivId) {		
			
		$.ajax({
			url: 'php_action/printGatepass.php',
			type: 'post',
			data: {sivId: sivId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
				mywindow.document.write('<html><head><title>Worku Andarge Auto Spare Part Imp. & Dis. PLC. Tel. +251913730691 Fax: +251111565568 </title>');        
				mywindow.document.write('</head><body>');
				mywindow.document.write('<h2><center>Gate Pass</center></h2>');
				mywindow.document.write(response);
				mywindow.document.write('</body></html>');

				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10

				mywindow.print();
				mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if srId
} // /print order function