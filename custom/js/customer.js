var manageCustomerTable;

$(document).ready(function() {
	// top bar active
	$('#navOrder').addClass('active');
	$('#topNavCustomer').addClass('active');
	// manage customer table
	manageCustomerTable = $("#manageCustomerTable").DataTable({
		'ajax': 'php_action/fetchCustomer.php',
		'order': []		
	});

	// submit customer form function
	$("#submitCustomerForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var customerName = $("#customerName").val();
		var customerCity = $("#customerCity").val();
		var customerContact = $("#customerContact").val();
		var customerPhone = $("#customerPhone").val();
		var customerFax = $("#customerFax").val();
		var customerEmail = $("#customerEmail").val();
		var customerTIN = $("#customerTIN").val();
		
		if(customerName == "") {
			$("#customerName").after('<p class="text-danger">Customer Name field is required</p>');
			$('#customerName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerName").find('.text-danger').remove();
			// success out for form 
			$("#customerName").closest('.form-group').addClass('has-success');	  	
		}

		if(customerCity == "") {
			$("#customerCity").after('<p class="text-danger">Customer City field is required</p>');
			$('#customerCity').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerCity").find('.text-danger').remove();
			// success out for form 
			$("#customerCity").closest('.form-group').addClass('has-success');	  	
		}
		if(customerContact == "") {
			$("#customerContact").after('<p class="text-danger">Customer Contact Name field is required</p>');
			$('#customerContact').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerContact").find('.text-danger').remove();
			// success out for form 
			$("#customerContact").closest('.form-group').addClass('has-success');	  	
		}
		if(customerPhone == "") {
			$("#customerPhone").after('<p class="text-danger">Customer Phone field is required</p>');
			$('#customerPhone').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerPhone").find('.text-danger').remove();
			// success out for form 
			$("#customerPhone").closest('.form-group').addClass('has-success');	  	
		}
		if(customerFax == "") {
			$("#customerFax").after('<p class="text-danger">Customer Fax field is required</p>');
			$('#customerFax').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerFax").find('.text-danger').remove();
			// success out for form 
			$("#customerFax").closest('.form-group').addClass('has-success');	  	
		}
		if(customerEmail == "") {
			$("#customerEmail").after('<p class="text-danger">Customer E-mail field is required</p>');
			$('#customerEmail').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerEmail").find('.text-danger').remove();
			// success out for form 
			$("#customerEmail").closest('.form-group').addClass('has-success');	  	
		}
		if(customerTIN == "") {
			$("#customerTIN").after('<p class="text-danger">Customer TIN field is required</p>');
			$('#customerTIN').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#customerTIN").find('.text-danger').remove();
			// success out for form 
			$("#customerTIN").closest('.form-group').addClass('has-success');	  	
		}

		if(customerName && customerTIN && customerEmail && customerPhone && customerFax && customerCity && customerContact) {
			var form = $(this);
			// button loading
			$("#createCustomerBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createCustomerBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageCustomerTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitCustomerForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-customer-messages').html('<div class="alert alert-success">'+
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
	}); // /submit customer form function

});

function editCustomers(customerId = null) {
	if(customerId) {
		// remove hidden customer id text
		$('#customerId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-customer-result').addClass('div-hide');
		// modal footer
		$('.editCustomerFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedCustomer.php',
			type: 'post',
			data: {customerId : customerId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-customer-result').removeClass('div-hide');
				// modal footer
				$('.editCustomerFooter').removeClass('div-hide');

				// setting the customer name value 
				$('#editCustomerName').val(response.customer_name);
				// setting the customer city value
				$('#editCustomerCity').val(response.city);
				// setting the customer contact value 
				$('#editCustomerContact').val(response.contact_name);
				// setting the customer phone value
				$('#editCustomerPhone').val(response.phone);
				// setting the customer fax value 
				$('#editCustomerFax').val(response.fax);
				// setting the customer email value
				$('#editCustomerEmail').val(response.email);
				// setting the customer TIN value 
				$('#editCustomerTIN').val(response.TIN);
				// customer id 
				$(".editCustomerFooter").after('<input type="hidden" name="customerId" id="customerId" value="'+response.customer_id+'" />');

				// update customer form 
				$('#editCustomerForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var customerName = $('#editCustomerName').val();
					var customerCity = $("#editCustomerCity").val();
					var customerContact = $("#editCustomerContact").val();
					var customerPhone = $("#editCustomerPhone").val();
					var customerFax = $("#editCustomerFax").val();
					var customerEmail = $("#editCustomerEmail").val();
					var customerTIN = $("#editCustomerTIN").val();

					if(customerName == "") {
						$("#editCustomerName").after('<p class="text-danger">Customer Name field is required</p>');
						$('#editCustomerName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerName").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerName").closest('.form-group').addClass('has-success');	  	
					}

					if(customerCity == "") {
						$("#editCustomerCity").after('<p class="text-danger">Customer City field is required</p>');
						$('#editCustomerCity').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerCity").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerCity").closest('.form-group').addClass('has-success');	  	
					}
					if(customerContact == "") {
						$("#editCustomerContact").after('<p class="text-danger">Customer Contact Name field is required</p>');
						$('#editCustomerContact').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerContact").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerContact").closest('.form-group').addClass('has-success');	  	
					}
					if(customerPhone == "") {
						$("#editCustomerPhone").after('<p class="text-danger">Customer Phone field is required</p>');
						$('#editCustomerPhone').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerPhone").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerPhone").closest('.form-group').addClass('has-success');	  	
					}
					if(customerFax == "") {
						$("#editCustomerFax").after('<p class="text-danger">Customer Fax field is required</p>');
						$('#editCustomerFax').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerFax").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerFax").closest('.form-group').addClass('has-success');	  	
					}
					if(customerEmail == "") {
						$("#editCustomerEmail").after('<p class="text-danger">Customer E-mail field is required</p>');
						$('#editCustomerEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerEmail").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerEmail").closest('.form-group').addClass('has-success');	  	
					}
					if(customerTIN == "") {
						$("#editCustomerTIN").after('<p class="text-danger">Customer TIN field is required</p>');
						$('#editCustomerTIN').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCustomerTIN").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerTIN").closest('.form-group').addClass('has-success');	  	
					}

				if(customerName && customerCity && customerContact && customerPhone && customerFax && customerEmail && customerTIN) {
					var form = $(this);

						// submit btn
						$('#editCustomerBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editCustomerBtn').button('reset');

									// reload the manage member table 
									manageCustomerTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-customer-messages').html('<div class="alert alert-success">'+
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
				}); // /update customer form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit customers function

function removeCustomers(customerId = null) {
	if(customerId) {
		$('#removeCustomerId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedCustomer.php',
			type: 'post',
			data: {customerId : customerId},
			dataType: 'json',
			success:function(response) {
				$('.removeCustomerFooter').after('<input type="hidden" name="removeCustomerId" id="removeCustomerId" value="'+response.customer_id+'" /> ');

				// click on remove button to remove the customer
				$("#removeCustomerBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeCustomerBtn").button('loading');

					$.ajax({
						url: 'php_action/removeCustomer.php',
						type: 'post',
						data: {customerId : customerId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeCustomerBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the customer table 
								manageCustomerTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the customer

				}); // /click on remove button to remove the customer

			} // /success
		}); // /ajax

		$('.removeCustomerFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove customers function