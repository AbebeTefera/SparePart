var manageLowstockTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	$('#topNavLowstock').addClass('active');
	// manage Low stock table
	manageLowstockTable = $('#manageLowstockTable').DataTable({
		'ajax': 'php_action/fetchLowstock.php',
		'order': []
	});
});

function addPR(productId = null) {
	if(productId) {
		// remove hidden product id text
		$('#productId').remove();

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
			url: 'php_action/fetchSelectedProduct.php',
			type: 'post',
			data: {productId : productId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-pr-result').removeClass('div-hide');
				// modal footer
				$('.editPRFooter').removeClass('div-hide');

				// setting the pr name value 
				$('#partNo').val(response.product_id);
				// setting the pr status value
				$('#prQuantity').val();
				// pr id 
				$(".editPRFooter").after('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');

				// update pr form 
				$('#editPRForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var partNo = $('#partNo').val();
					var prQuantity = $('#prQuantity').val();

					if(partNo == "") {
						$("#partNo").after('<p class="text-danger">Part No field is required</p>');
						$('#partNo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#partNo").find('.text-danger').remove();
						// success out for form 
						$("#partNo").closest('.form-group').addClass('has-success');	  	
					}

					if(prQuantity == "") {
						$("#prQuantity").after('<p class="text-danger">PR Quantity field is required</p>');

						$('#prQuantity').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#prQuantity").find('.text-danger').remove();
						// success out for form 
						$("#prQuantity").closest('.form-group').addClass('has-success');	  	
					}

					if(partNo && prQuantity) {
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
									manageLowstockTable.ajax.reload(null, false);								  	  										
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
} // /edit prs function