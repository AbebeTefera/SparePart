var manageUser_roleTable;

$(document).ready(function() {
	// top bar active
	$('#navAdmin').addClass('active');
	$('#topNavRole').addClass('active');
	
	// manage user_role table
	manageUser_roleTable = $("#manageUser_roleTable").DataTable({
		'ajax': 'php_action/fetchUser_role.php',
		'order': []		
	});

	// submit user_role form function
	$("#submitUser_roleForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var user_roleName = $("#user_roleName").val();
		var user_roleStatus = $("#user_roleStatus").val();

		if(user_roleName == "") {
			$("#user_roleName").after('<p class="text-danger">User_role Name field is required</p>');
			$('#user_roleName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#user_roleName").find('.text-danger').remove();
			// success out for form 
			$("#user_roleName").closest('.form-group').addClass('has-success');	  	
		}

		if(user_roleStatus == "") {
			$("#user_roleStatus").after('<p class="text-danger">User_role Status field is required</p>');

			$('#user_roleStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#user_roleStatus").find('.text-danger').remove();
			// success out for form 
			$("#user_roleStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(user_roleName && user_roleStatus) {
			var form = $(this);
			// button loading
			$("#createUser_roleBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createUser_roleBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageUser_roleTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitUser_roleForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-user_role-messages').html('<div class="alert alert-success">'+
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
	}); // /submit user_role form function

});

function editUser_roles(user_roleId = null) {
	if(user_roleId) {
		// remove hidden user_role id text
		$('#user_roleId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-user_role-result').addClass('div-hide');
		// modal footer
		$('.editUser_roleFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUser_role.php',
			type: 'post',
			data: {user_roleId : user_roleId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-user_role-result').removeClass('div-hide');
				// modal footer
				$('.editUser_roleFooter').removeClass('div-hide');

				// setting the user_role name value 
				$('#editUser_roleName').val(response.user_role);
				// setting the user_role status value
				$('#editUser_roleStatus').val(response.user_role_active);
				// user_role id 
				$(".editUser_roleFooter").after('<input type="hidden" name="user_roleId" id="user_roleId" value="'+response.user_role_id+'" />');

				// update user_role form 
				$('#editUser_roleForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var user_roleName = $('#editUser_roleName').val();
					var user_roleStatus = $('#editUser_roleStatus').val();

					if(user_roleName == "") {
						$("#editUser_roleName").after('<p class="text-danger">User_role Name field is required</p>');
						$('#editUser_roleName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUser_roleName").find('.text-danger').remove();
						// success out for form 
						$("#editUser_roleName").closest('.form-group').addClass('has-success');	  	
					}

					if(user_roleStatus == "") {
						$("#editUser_roleStatus").after('<p class="text-danger">User_role Status field is required</p>');

						$('#editUser_roleStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editUser_roleStatus").find('.text-danger').remove();
						// success out for form 
						$("#editUser_roleStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(user_roleName && user_roleStatus) {
						var form = $(this);

						// submit btn
						$('#editUser_roleBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editUser_roleBtn').button('reset');

									// reload the manage member table 
									manageUser_roleTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-user_role-messages').html('<div class="alert alert-success">'+
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
				}); // /update user_role form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit user_roles function

function removeUser_roles(user_roleId = null) {
	if(user_roleId) {
		$('#removeUser_roleId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUser_role.php',
			type: 'post',
			data: {user_roleId : user_roleId},
			dataType: 'json',
			success:function(response) {
				$('.removeUser_roleFooter').after('<input type="hidden" name="removeUser_roleId" id="removeUser_roleId" value="'+response.user_role_id+'" /> ');

				// click on remove button to remove the user_role
				$("#removeUser_roleBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeUser_roleBtn").button('loading');

					$.ajax({
						url: 'php_action/removeUser_role.php',
						type: 'post',
						data: {user_roleId : user_roleId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeUser_roleBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the user_role table 
								manageUser_roleTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the user_role

				}); // /click on remove button to remove the user_role

			} // /success
		}); // /ajax

		$('.removeUser_roleFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove user_roles function