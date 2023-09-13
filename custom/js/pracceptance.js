var PRAcceptanceTable;
$(document).ready(function() {
	// top bar active
	$('#navPurchase').addClass('active');	
	$('#navPRAcc').addClass('active');
	// manage pr table
	PRAcceptanceTable = $("#PRAcceptanceTable").DataTable({
		'ajax': 'php_action/fetchPRAcceptance.php',
		'order': []		
	});
	// submit pr form function
});
function editPRAcc(prId = null) {
	if(prId) {
		// remove hidden pr id text
		$('#prId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-pr-result').addClass('div-hide');
		// modal footer
		$('.editPRFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedPR.php',
			type: 'post',
			data: {prId : prId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-pr-result').removeClass('div-hide');
				// modal footer
				$('.editPRFooter').removeClass('div-hide');

				// setting the PR Acceptance value 
				$('#PRAcceptance').val(response.pr_acceptance);
				// setting the PR note value 
				$('#note').val(response.note);
				// pr id 
				$(".editPRFooter").after('<input type="hidden" name="prId" id="prId" value="'+response.pr_id+'" />');

				// update pr form 
				$('#editPRForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var PRAcceptance = $('#PRAcceptance').val();
					var note = $('#note').val();
					
					if(PRAcceptance == "") {
						$("#PRAcceptance").after('<p class="text-danger">PR Accepgance field is required</p>');
						$('#PRAcceptance').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#PRAcceptance").find('.text-danger').remove();
						// success out for form 
						$("#PRAcceptance").closest('.form-group').addClass('has-success');	  	
					}

					if(PRAcceptance && note) {
						var form = $(this);

						// submit btn
						$('#editPRBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editPRBtn').button('reset');

									// reload the manage member table 
									PRAcceptanceTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-pr-messages').html('<div class="alert alert-success">'+
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
				}); // /update pr form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /Acceptance prs function