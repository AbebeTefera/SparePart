var managePrice_schemeTable;

$(document).ready(function() {
	// top bar active
	$('#navPrice').addClass('active');
	$('#navPricescheme').addClass('active');
	
	// manage price_scheme table
	managePrice_schemeTable = $("#managePrice_schemeTable").DataTable({
		'ajax': 'php_action/fetchPrice_scheme.php',
		'order': []		
	});

	// submit price_scheme form function
	$("#submitPrice_schemeForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var price_schemeName = $("#price_schemeName").val();
		var price_schemeDiscount = $("#price_schemeDiscount").val();
		var price_schemeStatus = $("#price_schemeStatus").val();

		if(price_schemeName == "") {
			$("#price_schemeName").after('<p class="text-danger">Price_scheme Name field is required</p>');
			$('#price_schemeName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#price_schemeName").find('.text-danger').remove();
			// success out for form 
			$("#price_schemeName").closest('.form-group').addClass('has-success');	  	
		}

		if(price_schemeDiscount == "") {
			$("#price_schemeDiscount").after('<p class="text-danger">Price_scheme Discount field is required</p>');
			$('#price_schemeDiscount').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#price_schemeDiscount").find('.text-danger').remove();
			// success out for form 
			$("#price_schemeDiscount").closest('.form-group').addClass('has-success');	  	
		}
		
		if(price_schemeStatus == "") {
			$("#price_schemeStatus").after('<p class="text-danger">Price_scheme Name field is required</p>');

			$('#price_schemeStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#price_schemeStatus").find('.text-danger').remove();
			// success out for form 
			$("#price_schemeStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(price_schemeName && price_schemeDiscount && price_schemeStatus) {
			var form = $(this);
			// button loading
			$("#createPrice_schemeBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createPrice_schemeBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						managePrice_schemeTable.ajax.reload(null, false);						
						// reset the form text
						$("#submitPrice_schemeForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-price_scheme-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if
				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit price_scheme form function

});

function editPrice_schemes(price_schemeId = null) {
	if(price_schemeId) {
		// remove hidden price_scheme id text
		$('#price_schemeId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-price_scheme-result').addClass('div-hide');
		// modal footer
		$('.editPrice_schemeFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedPrice_scheme.php',
			type: 'post',
			data: {price_schemeId : price_schemeId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-price_scheme-result').removeClass('div-hide');
				// modal footer
				$('.editPrice_schemeFooter').removeClass('div-hide');

				// setting the price_scheme name value 
				$('#editPrice_schemeName').val(response.Price_scheme);
				// setting the price_scheme discount value 
				$('#editPrice_schemeDiscount').val(response.Discount_percentage);
				// setting the price_scheme status value
				$('#editPrice_schemeStatus').val(response.price_active);
				// price_scheme id 
				$(".editPrice_schemeFooter").after('<input type="hidden" name="price_schemeId" id="price_schemeId" value="'+response.price_id+'" />');

				// update price_scheme form 
				$('#editPrice_schemeForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var price_schemeName = $('#editPrice_schemeName').val();
					var price_schemeDiscount = $('#editPrice_schemeDiscount').val();
					var price_schemeStatus = $('#editPrice_schemeStatus').val();

					if(price_schemeName == "") {
						$("#editPrice_schemeName").after('<p class="text-danger">Price scheme Name field is required</p>');
						$('#editPrice_schemeName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPrice_schemeName").find('.text-danger').remove();
						// success out for form 
						$("#editPrice_schemeName").closest('.form-group').addClass('has-success');	  	
					}

					if(price_schemeDiscount == "") {
						$("#editPrice_schemeDiscount").after('<p class="text-danger">Price scheme Discount field is required</p>');
						$('#editPrice_schemeDiscount').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPrice_schemeDiscount").find('.text-danger').remove();
						// success out for form 
						$("#editPrice_schemeDiscount").closest('.form-group').addClass('has-success');	  	
					}
					
					if(price_schemeStatus == "") {
						$("#editPrice_schemeStatus").after('<p class="text-danger">Price scheme Status field is required</p>');

						$('#editPrice_schemeStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editPrice_schemeStatus").find('.text-danger').remove();
						// success out for form 
						$("#editPrice_schemeStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(price_schemeName && price_schemeDiscount && price_schemeStatus) {
						var form = $(this);

						// submit btn
						$('#editPrice_schemeBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editPrice_schemeBtn').button('reset');

									// reload the manage member table 
									managePrice_schemeTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-price_scheme-messages').html('<div class="alert alert-success">'+
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
				}); // /update price_scheme form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit price_schemes function

function removePrice_schemes(price_schemeId = null) {
	if(price_schemeId) {
		$('#removePrice_schemeId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedPrice_scheme.php',
			type: 'post',
			data: {price_schemeId : price_schemeId},
			dataType: 'json',
			success:function(response) {
				$('.removePrice_schemeFooter').after('<input type="hidden" name="removePrice_schemeId" id="removePrice_schemeId" value="'+response.price_scheme_id+'" /> ');

				// click on remove button to remove the price_scheme
				$("#removePrice_schemeBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removePrice_schemeBtn").button('loading');

					$.ajax({
						url: 'php_action/removePrice_scheme.php',
						type: 'post',
						data: {price_schemeId : price_schemeId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removePrice_schemeBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the price_scheme table 
								managePrice_schemeTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the price_scheme

				}); // /click on remove button to remove the price_scheme

			} // /success
		}); // /ajax

		$('.removePrice_schemeFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove price_schemes function