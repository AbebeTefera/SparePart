var manageStock_unitTable;

$(document).ready(function() {
	// top bar active
	$('#navProduct').addClass('active');
	$('#navStockUnit').addClass('active');
	
	// manage stock_unit table
	manageStock_unitTable = $("#manageStock_unitTable").DataTable({
		'ajax': 'php_action/fetchStock_unit.php',
		'order': []		
	});

	// submit stock_unit form function
	$("#submitStock_unitForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var stock_unitDescription = $("#stock_unitDescription").val();
		
		if(stock_unitDescription == "") {
			$("#stock_unitDescription").after('<p class="text-danger">Stock_unit Name field is required</p>');
			$('#stock_unitDescription').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#stock_unitDescription").find('.text-danger').remove();
			// success out for form 
			$("#stock_unitDescription").closest('.form-group').addClass('has-success');	  	
		}

		if(stock_unitDescription) {
			var form = $(this);
			// button loading
			$("#createStock_unitBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createStock_unitBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageStock_unitTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitStock_unitForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-stock_unit-messages').html('<div class="alert alert-success">'+
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
	}); // /submit stock_unit form function

});

function editStock_units(stock_unitId = null) {
	if(stock_unitId) {
		// remove hidden stock_unit id text
		$('#stock_unitId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-stock_unit-result').addClass('div-hide');
		// modal footer
		$('.editStock_unitFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedStock_unit.php',
			type: 'post',
			data: {stock_unitId : stock_unitId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-stock_unit-result').removeClass('div-hide');
				// modal footer
				$('.editStock_unitFooter').removeClass('div-hide');

				// setting the stock_unit description value 
				$('#editStock_unitDescription').val(response.stock_unit_description);
				// stock_unit id 
				$(".editStock_unitFooter").after('<input type="hidden" name="stock_unitId" id="stock_unitId" value="'+response.stock_unit_id+'" />');

				// update stock_unit form 
				$('#editStock_unitForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var stock_unitDescription = $('#editStock_unitDescription').val();
					
					if(stock_unitDescription == "") {
						$("#editStock_unitDescription").after('<p class="text-danger">Stock_unit Description field is required</p>');
						$('#editStock_unitDescription').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editStock_unitDescription").find('.text-danger').remove();
						// success out for form 
						$("#editStock_unitDescription").closest('.form-group').addClass('has-success');	  	
					}

					
					if(stock_unitDescription) {
						var form = $(this);

						// submit btn
						$('#editStock_unitBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editStock_unitBtn').button('reset');

									// reload the manage member table 
									manageStock_unitTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-stock_unit-messages').html('<div class="alert alert-success">'+
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
				}); // /update stock_unit form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit stock_units function

function removeStock_units(stock_unitId = null) {
	if(stock_unitId) {
		$('#removeStock_unitId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedStock_unit.php',
			type: 'post',
			data: {stock_unitId : stock_unitId},
			dataType: 'json',
			success:function(response) {
				$('.removeStock_unitFooter').after('<input type="hidden" name="removeStock_unitId" id="removeStock_unitId" value="'+response.stock_unit_id+'" /> ');

				// click on remove button to remove the stock_unit
				$("#removeStock_unitBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeStock_unitBtn").button('loading');

					$.ajax({
						url: 'php_action/removeStock_unit.php',
						type: 'post',
						data: {stock_unitId : stock_unitId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeStock_unitBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the stock_unit table 
								manageStock_unitTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the stock_unit

				}); // /click on remove button to remove the stock_unit

			} // /success
		}); // /ajax

		$('.removeStock_unitFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove stock_units function