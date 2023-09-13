var GRNAcceptanceTable;
$(document).ready(function() {
	// top bar active
	$('#navStore').addClass('active');	
	$('#navGRNAcc').addClass('active');
	// manage grn table
	GRNAcceptanceTable = $("#GRNAcceptanceTable").DataTable({
		'ajax': 'php_action/fetchGRNAcceptance.php',
		'order': []		
	});
	// submit grn form function
});
function editGRNAcc(grnId = null) {
	if(grnId) {
		// remove hidden grn id text
		$('#grnId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-grn-result').addClass('div-hide');
		// modal footer
		$('.editGRNFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedGRN.php',
			type: 'post',
			data: {grnId : grnId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-grn-result').removeClass('div-hide');
				// modal footer
				$('.editGRNFooter').removeClass('div-hide');

				// setting the GRN Acceptance value 
				$('#GRNAcceptance').val(response.grn_acceptance);
				// setting the note value 
				$('#note').val(response.note);
				// grn id 
				$(".editGRNFooter").after('<input type="hidden" name="grnId" id="grnId" value="'+response.grn_id+'" />');

				// update grn form 
				$('#editGRNForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var GRNAcceptance = $('#GRNAcceptance').val();
					var note = $('#note').val();
					
					if(GRNAcceptance == "") {
						$("#GRNAcceptance").after('<p class="text-danger">GRN Accepgance field is required</p>');
						$('#GRNAcceptance').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#GRNAcceptance").find('.text-danger').remove();
						// success out for form 
						$("#GRNAcceptance").closest('.form-group').addClass('has-success');	  	
					}
					if(note == "" && note !="") {
						// remove error text field
						$("#note").find('.text-danger').remove();
						// success out for form 
						$("#note").closest('.form-group').addClass('has-success');	  	
					}

					if(GRNAcceptance && note) {
						var form = $(this);

						// submit btn
						$('#editGRNBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editGRNBtn').button('reset');

									// reload the manage member table 
									GRNAcceptanceTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-grn-messages').html('<div class="alert alert-success">'+
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
				}); // /update grn form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /Acceptance grns function