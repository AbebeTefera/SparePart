var SRAcceptanceTable;
$(document).ready(function() {
	// top bar active
	$('#navInvoice').addClass('active');	
	$('#topNavSR').addClass('active');
	// manage sr table
	SRAcceptanceTable = $("#SRAcceptanceTable").DataTable({
		'ajax': 'php_action/fetchSR.php',
		'order': []		
	});
	// submit sr form function
});
function editSRAcc(srId = null) {
	if(srId) {
		// remove hidden sr id text
		$('#srId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-sr-result').addClass('div-hide');
		// modal footer
		$('.editSRFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedSR.php',
			type: 'post',
			data: {srId : srId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-sr-result').removeClass('div-hide');
				// modal footer
				$('.editSRFooter').removeClass('div-hide');

				// setting the SR Acceptance value 
				$('#SRAcceptance').val(response.sr_acceptance);
				// setting the SR note value 
				$('#note').val(response.note);
				// sr id 
				$(".editSRFooter").after('<input type="hidden" name="srId" id="srId" value="'+response.sr_id+'" />');

				// update sr form 
				$('#editSRForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var SRAcceptance = $('#SRAcceptance').val();
					var note = $('#note').val();
					if(SRAcceptance == "") {
						$("#SRAcceptance").after('<p class="text-danger">SR Accepgance field is required</p>');

						$('#SRAcceptance').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#SRAcceptance").find('.text-danger').remove();
						// success out for form 
						$("#SRAcceptance").closest('.form-group').addClass('has-success');	  	
					}

					if(SRAcceptance && note) {
						var form = $(this);

						// submit btn
						$('#editSRBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editSRBtn').button('reset');

									// reload the manage member table 
									SRAcceptanceTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-sr-messages').html('<div class="alert alert-success">'+
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
				}); // /update sr form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /Acceptance srs function