var managePRTable;

$(document).ready(function() {
	// top bar active
	$('#navStore').addClass('active');
	$('#navPRStore').addClass('active');
	
	// manage pr table
	managePRTable = $("#managePRTable").DataTable({
		'ajax': 'php_action/fetchPR.php',
		'order': []		
	});

	// submit pr form function
	$("#submitPRForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var partNo = $("#partNo").val();
		var prQuantity = $("#prQuantity").val();

		if(partNo == "") {
			$("#partNo").after('<p class="text-danger">Part No. field is required</p>');
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
			// remov error text field
			$("#prQuantity").find('.text-danger').remove();
			// success out for form 
			$("#prQuantity").closest('.form-group').addClass('has-success');	  	
		}

		if(partNo && prQuantity) {
			var form = $(this);
			// button loading
			$("#createPRBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createPRBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						managePRTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitPRForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-pr-messages').html('<div class="alert alert-success">'+
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
	}); // /submit pr form function

});

function editPRs(prId = null) {
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

				// setting the pr name value 
				$('#editPartNo').val(response.product_id);
				// setting the pr status value
				$('#editPrQuantity').val(response.pr_quantity);
				// pr id 
				$(".editPRFooter").after('<input type="hidden" name="prId" id="prId" value="'+response.pr_id+'" />');

				// update pr form 
				$('#editPRForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var partNo = $('#editPartNo').val();
					var prQuantity = $('#editPrQuantity').val();

					if(partNo == "") {
						$("#editPartNo").after('<p class="text-danger">Part No field is required</p>');
						$('#editPartNo').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPartNo").find('.text-danger').remove();
						// success out for form 
						$("#editPartNo").closest('.form-group').addClass('has-success');	  	
					}

					if(prQuantity == "") {
						$("#editPrQuantity").after('<p class="text-danger">PR Quantity field is required</p>');

						$('#editPrQuantity').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editPrQuantity").find('.text-danger').remove();
						// success out for form 
						$("#editPrQuantity").closest('.form-group').addClass('has-success');	  	
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
									managePRTable.ajax.reload(null, false);								  	  										
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

function removePRs(prId = null) {
	if(prId) {
		$('#removePRId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedPR.php',
			type: 'post',
			data: {prId : prId},
			dataType: 'json',
			success:function(response) {
				$('.removePRFooter').after('<input type="hidden" name="removePRId" id="removePRId" value="'+response.pr_id+'" /> ');

				// click on remove button to remove the pr
				$("#removePRBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removePRBtn").button('loading');

					$.ajax({
						url: 'php_action/removePR.php',
						type: 'post',
						data: {prId : prId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removePRBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the pr table 
								managePRTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the pr

				}); // /click on remove button to remove the pr

			} // /success
		}); // /ajax

		$('.removePRFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove prs function