var manageVendorTable;

$(document).ready(function() {
	// top bar active
	$('#navPurchase').addClass('active');
	$('#topNavVendor').addClass('active');
	
	// manage vendor table
	manageVendorTable = $("#manageVendorTable").DataTable({
		'ajax': 'php_action/fetchVendor.php',
		'order': []		
	});

	// submit vendor form function
	$("#submitVendorForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var vendorName = $("#vendorName").val();
		var vendorCountry = $("#vendorCountry").val();
		var vendorCity = $("#vendorCity").val();
		var vendorContact = $("#vendorContact").val();
		var vendorPhone = $("#vendorPhone").val();
		var vendorFax = $("#vendorFax").val();
		var vendorEmail = $("#vendorEmail").val();
		var vendorWebsite = $("#vendorWebsite").val();
		
		if(vendorName == "") {
			$("#vendorName").after('<p class="text-danger">Vendor Name field is required</p>');
			$('#vendorName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorName").find('.text-danger').remove();
			// success out for form 
			$("#vendorName").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorCountry == "") {
			$("#vendorCountry").after('<p class="text-danger">Vendor Country field is required</p>');
			$('#vendorCountry').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorCountry").find('.text-danger').remove();
			// success out for form 
			$("#vendorCountry").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorCity == "") {
			$("#vendorCity").after('<p class="text-danger">Vendor City field is required</p>');
			$('#vendorCity').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorCity").find('.text-danger').remove();
			// success out for form 
			$("#vendorCity").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorContact == "") {
			$("#vendorContact").after('<p class="text-danger">Vendor Contact Name field is required</p>');
			$('#vendorContact').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorContact").find('.text-danger').remove();
			// success out for form 
			$("#vendorContact").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorPhone == "") {
			$("#vendorPhone").after('<p class="text-danger">Vendor Phone field is required</p>');
			$('#vendorPhone').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorPhone").find('.text-danger').remove();
			// success out for form 
			$("#vendorPhone").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorFax == "") {
			$("#vendorFax").after('<p class="text-danger">Vendor Fax field is required</p>');
			$('#vendorFax').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorFax").find('.text-danger').remove();
			// success out for form 
			$("#vendorFax").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorEmail == "") {
			$("#vendorEmail").after('<p class="text-danger">Vendor E-mail field is required</p>');
			$('#vendorEmail').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorEmail").find('.text-danger').remove();
			// success out for form 
			$("#vendorEmail").closest('.form-group').addClass('has-success');	  	
		}
		if(vendorWebsite == "") {
			$("#vendorWebsite").after('<p class="text-danger">Vendor Website field is required</p>');
			$('#vendorWebsite').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#vendorWebsite").find('.text-danger').remove();
			// success out for form 
			$("#vendorWebsite").closest('.form-group').addClass('has-success');	  	
		}

		if(vendorName && vendorCountry && vendorWebsite && vendorEmail && vendorPhone && vendorFax && vendorCity && vendorContact) {
			var form = $(this);
			// button loading
			$("#createVendorBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createVendorBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageVendorTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitVendorForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-vendor-messages').html('<div class="alert alert-success">'+
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
	}); // /submit vendor form function

});

function editVendors(vendorId = null) {
	if(vendorId) {
		// remove hidden vendor id text
		$('#vendorId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-vendor-result').addClass('div-hide');
		// modal footer
		$('.editVendorFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedVendor.php',
			type: 'post',
			data: {vendorId : vendorId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-vendor-result').removeClass('div-hide');
				// modal footer
				$('.editVendorFooter').removeClass('div-hide');

				// setting the vendor name value 
				$('#editVendorName').val(response.vendor_name);
				// setting the vendor country value 
				$('#editVendorCountry').val(response.country);
				// setting the vendor city value
				$('#editVendorCity').val(response.city);
				// setting the vendor contact value 
				$('#editVendorContact').val(response.contact_name);
				// setting the vendor phone value
				$('#editVendorPhone').val(response.phone);
				// setting the vendor fax value 
				$('#editVendorFax').val(response.fax);
				// setting the vendor email value
				$('#editVendorEmail').val(response.email);
				// setting the vendor Website value 
				$('#editVendorWebsite').val(response.website);
				// vendor id 
				$(".editVendorFooter").after('<input type="hidden" name="vendorId" id="vendorId" value="'+response.vendor_id+'" />');

				// update vendor form 
				$('#editVendorForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var vendorName = $('#editVendorName').val();
					var vendorCountry = $('#editVendorCountry').val();
					var vendorCity = $("#editVendorCity").val();
					var vendorContact = $("#editVendorContact").val();
					var vendorPhone = $("#editVendorPhone").val();
					var vendorFax = $("#editVendorFax").val();
					var vendorEmail = $("#editVendorEmail").val();
					var vendorWebsite = $("#editVendorWebsite").val();

					if(vendorName == "") {
						$("#editVendorName").after('<p class="text-danger">Vendor Name field is required</p>');
						$('#editVendorName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorName").find('.text-danger').remove();
						// success out for form 
						$("#editVendorName").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorCountry == "") {
						$("#editVendorCountry").after('<p class="text-danger">Vendor Country field is required</p>');
						$('#editVendorCountry').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorCountry").find('.text-danger').remove();
						// success out for form 
						$("#editVendorCountry").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorCity == "") {
						$("#editVendorCity").after('<p class="text-danger">Vendor City field is required</p>');
						$('#editVendorCity').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorCity").find('.text-danger').remove();
						// success out for form 
						$("#editVendorCity").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorContact == "") {
						$("#editVendorContact").after('<p class="text-danger">Vendor Contact Name field is required</p>');
						$('#editVendorContact').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorContact").find('.text-danger').remove();
						// success out for form 
						$("#editVendorContact").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorPhone == "") {
						$("#editVendorPhone").after('<p class="text-danger">Vendor Phone field is required</p>');
						$('#editVendorPhone').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorPhone").find('.text-danger').remove();
						// success out for form 
						$("#editVendorPhone").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorFax == "") {
						$("#editVendorFax").after('<p class="text-danger">Vendor Fax field is required</p>');
						$('#editVendorFax').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorFax").find('.text-danger').remove();
						// success out for form 
						$("#editVendorFax").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorEmail == "") {
						$("#editVendorEmail").after('<p class="text-danger">Vendor E-mail field is required</p>');
						$('#editVendorEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorEmail").find('.text-danger').remove();
						// success out for form 
						$("#editVendorEmail").closest('.form-group').addClass('has-success');	  	
					}
					if(vendorWebsite == "") {
						$("#editVendorWebsite").after('<p class="text-danger">Vendor Website field is required</p>');
						$('#editVendorWebsite').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editVendorWebsite").find('.text-danger').remove();
						// success out for form 
						$("#editVendorWebsite").closest('.form-group').addClass('has-success');	  	
					}

				if(vendorName && vendorCountry && vendorCity && vendorContact && vendorPhone && vendorFax && vendorEmail && vendorWebsite) {
					var form = $(this);

						// submit btn
						$('#editVendorBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editVendorBtn').button('reset');

									// reload the manage member table 
									manageVendorTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-vendor-messages').html('<div class="alert alert-success">'+
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
				}); // /update vendor form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit vendors function

function removeVendors(vendorId = null) {
	if(vendorId) {
		$('#removeVendorId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedVendor.php',
			type: 'post',
			data: {vendorId : vendorId},
			dataType: 'json',
			success:function(response) {
				$('.removeVendorFooter').after('<input type="hidden" name="removeVendorId" id="removeVendorId" value="'+response.vendor_id+'" /> ');

				// click on remove button to remove the vendor
				$("#removeVendorBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeVendorBtn").button('loading');

					$.ajax({
						url: 'php_action/removeVendor.php',
						type: 'post',
						data: {vendorId : vendorId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeVendorBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the vendor table 
								manageVendorTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the vendor

				}); // /click on remove button to remove the vendor

			} // /success
		}); // /ajax

		$('.removeVendorFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove vendors function