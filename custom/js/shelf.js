var manageShelfTable;

$(document).ready(function() {
	// top bar active
	$('#navProduct').addClass('active');
	$('#navShelf').addClass('active');
	
	// manage shelf table
	manageShelfTable = $("#manageShelfTable").DataTable({
		'ajax': 'php_action/fetchShelf.php',
		'order': []		
	});

	// submit shelf form function
	$("#submitShelfForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var shelfDescription = $("#shelfDescription").val();
		
		if(shelfDescription == "") {
			$("#shelfDescription").after('<p class="text-danger">Shelf Name field is required</p>');
			$('#shelfDescription').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#shelfDescription").find('.text-danger').remove();
			// success out for form 
			$("#shelfDescription").closest('.form-group').addClass('has-success');	  	
		}

		if(shelfDescription) {
			var form = $(this);
			// button loading
			$("#createShelfBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createShelfBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageShelfTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitShelfForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-shelf-messages').html('<div class="alert alert-success">'+
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
	}); // /submit shelf form function

});

function editShelfs(shelfId = null) {
	if(shelfId) {
		// remove hidden shelf id text
		$('#shelfId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-shelf-result').addClass('div-hide');
		// modal footer
		$('.editShelfFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedShelf.php',
			type: 'post',
			data: {shelfId : shelfId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-shelf-result').removeClass('div-hide');
				// modal footer
				$('.editShelfFooter').removeClass('div-hide');

				// setting the shelf description value 
				$('#editShelfDescription').val(response.shelf_description);
				// shelf id 
				$(".editShelfFooter").after('<input type="hidden" name="shelfId" id="shelfId" value="'+response.shelf_id+'" />');

				// update shelf form 
				$('#editShelfForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var shelfDescription = $('#editShelfDescription').val();
					
					if(shelfDescription == "") {
						$("#editShelfDescription").after('<p class="text-danger">Shelf Description field is required</p>');
						$('#editShelfDescription').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editShelfDescription").find('.text-danger').remove();
						// success out for form 
						$("#editShelfDescription").closest('.form-group').addClass('has-success');	  	
					}

					
					if(shelfDescription) {
						var form = $(this);

						// submit btn
						$('#editShelfBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editShelfBtn').button('reset');

									// reload the manage member table 
									manageShelfTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-shelf-messages').html('<div class="alert alert-success">'+
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
				}); // /update shelf form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit shelfs function

function removeShelfs(shelfId = null) {
	if(shelfId) {
		$('#removeShelfId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedShelf.php',
			type: 'post',
			data: {shelfId : shelfId},
			dataType: 'json',
			success:function(response) {
				$('.removeShelfFooter').after('<input type="hidden" name="removeShelfId" id="removeShelfId" value="'+response.shelf_id+'" /> ');

				// click on remove button to remove the shelf
				$("#removeShelfBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeShelfBtn").button('loading');

					$.ajax({
						url: 'php_action/removeShelf.php',
						type: 'post',
						data: {shelfId : shelfId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeShelfBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the shelf table 
								manageShelfTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the shelf

				}); // /click on remove button to remove the shelf

			} // /success
		}); // /ajax

		$('.removeShelfFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove shelfs function