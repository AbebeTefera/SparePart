var editSellingPriceTable;
$(document).ready(function() {
	// top bar active
	$('#navPrice').addClass('active');	
	$('#navManagePrice').addClass('active');
	// manage price table
	editSellingPriceTable = $("#managePriceTable").DataTable({
		'ajax': 'php_action/fetchPrice.php',
		'order': []		
	});
	// submit price form function
});
function editPrice(productId = null) {
	if(productId) {
		// remove hidden price id text
		$('#productId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-price-result').addClass('div-hide');
		// modal footer
		$('.editPriceFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedPrice.php',
			type: 'post',
			data: {productId : productId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-price-result').removeClass('div-hide');
				// modal footer
				$('.editPriceFooter').removeClass('div-hide');

				// setting the Price Acceptance value 
				$('#editSellingPrice').val(response.selling_price);
				// price id 
				$(".editPriceFooter").after('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');

				// update price form 
				$('#editPriceForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var editSellingPrice = $('#editSellingPrice').val();
					
					if(editSellingPrice == "") {
						$("#editSellingPrice").after('<p class="text-danger">Price field is required</p>');

						$('#editSellingPrice').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editSellingPrice").find('.text-danger').remove();
						// success out for form 
						$("#editSellingPrice").closest('.form-group').addClass('has-success');	  	
					}

					if(editSellingPrice) {
						var form = $(this);

						// submit btn
						$('#editPriceBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editPriceBtn').button('reset');

									// reload the manage member table 
									editSellingPriceTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-price-messages').html('<div class="alert alert-success">'+
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
				}); // /update price form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // edit price function