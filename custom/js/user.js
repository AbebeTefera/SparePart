var manageUserTable;

$(document).ready(function() {
	// top bar active
	$('#navAdmin').addClass('active');
	$('#topNavUser').addClass('active');
	
	// manage user table
	manageUserTable = $("#manageUserTable").DataTable({
		'ajax': 'php_action/fetchUser.php',
		'order': []		
	});
	
	// submit user form function
	$("#submitUserForm").unbind('submit').bind('submit', function() {			
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var userFirstname = $("#userFirstname").val();
		var userLastname = $("#userLastname").val();
		var userName = $("#userName").val();
		var userPassword = $("#userPassword").val();
		var userConfirmpassword = $("#userConfirmpassword").val();
		var userEmail = $("#userEmail").val();
		var userRole = $("#userRole").val();
		var userStatus = $("#userStatus").val();
		var re = /^\w+$/;
		
		if(userName == "") {
				$("#userName").after('<p class="text-danger">User Name field is required</p>');
				$('#userName').closest('.form-group').addClass('has-error');
			} 
			else {
				// remov error text field
				$("#userName").find('.text-danger').remove();
				// success out for form 
				$("#userName").closest('.form-group').addClass('has-success');	  	
			}
		if(userFirstname == "") {
			$("#userFirstname").after('<p class="text-danger">First Name field is required</p>');
			$('#userFirstname').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userFirstname").find('.text-danger').remove();
			// success out for form 
			$("#userFirstname").closest('.form-group').addClass('has-success');	  	
		}
		if(userLastname == "") {
			$("#userLastname").after('<p class="text-danger">Last Name field is required</p>');
			$('#userLastname').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userLastname").find('.text-danger').remove();
			// success out for form 
			$("#userLastname").closest('.form-group').addClass('has-success');	  	
		}
		if(userPassword == "") {
			$("#userPassword").after('<p class="text-danger">Password field is required</p>');
			$('#userPassword').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userPassword").find('.text-danger').remove();
			// success out for form 
			$("#userPassword").closest('.form-group').addClass('has-success');	  	
		}
		
		if(userConfirmpassword == "") {
			$("#userConfirmpassword").after('<p class="text-danger">Confirm Password field is required</p>');
			$('#userConfirmpassword').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userConfirmpassword").find('.text-danger').remove();
			// success out for form 
			$("#userConfirmpassword").closest('.form-group').addClass('has-success');	  	
		}
		if(userConfirmpassword !== userPassword ) {
			$("#userConfirmpassword").after('<p class="text-danger">Confirm Password and Password fields should be the same</p>');
			$('#userConfirmpassword').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userConfirmpassword").find('.text-danger').remove();
			// success out for form 
			$("#userConfirmpassword").closest('.form-group').addClass('has-success');	  	
		}
		if(userEmail == "") {
			$("#userEmail").after('<p class="text-danger">Email field is required</p>');
			$('#userEmail').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userEmail").find('.text-danger').remove();
			// success out for form 
			$("#userEmail").closest('.form-group').addClass('has-success');	  	
		}
		if(userRole == "") {
			$("#userRole").after('<p class="text-danger">User Role field is required</p>');
			$('#userRole').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userRole").find('.text-danger').remove();
			// success out for form 
			$("#userRole").closest('.form-group').addClass('has-success');	  	
		}
		if(userStatus == "") {
			$("#userStatus").after('<p class="text-danger">User Status field is required</p>');

			$('#userStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#userStatus").find('.text-danger').remove();
			// success out for form 
			$("#userStatus").closest('.form-group').addClass('has-success');	  	
		}

		if(userName && userFirstname && userLastname && userRole && userEmail && userPassword && userStatus) {
			var form = $(this);
			// button loading
			$("#createUserBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createUserBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageUserTable.ajax.reload(null, false);						

						// reset the form text
						$("#submitUserForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-user-messages').html('<div class="alert alert-success">'+
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
	
	}); // /submit user form function

});

function editUsers(userId = null) {
	if(userId) {
		// remove hidden user id text
		$('#userId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-user-result').addClass('div-hide');
		// modal footer
		$('.editUserFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {userId : userId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-user-result').removeClass('div-hide');
				// modal footer
				$('.editUserFooter').removeClass('div-hide');

				// setting the user name value 
				$('#editUserName').val(response.user_name);
				$('#editUserFirstname').val(response.first_name);
				$('#editUserLastname').val(response.last_name);
				$('#editUserRole').val(response.user_role_id);
				$('#editUserStatus').val(response.user_active);
				$('#editUserEmail').val(response.email);
				// user id 
				$(".editUserFooter").after('<input type="hidden" name="userId" id="userId" value="'+response.user_id+'" />');

				// update user form 
				$('#editUserForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var userName = $('#editUserName').val();
					var userStatus = $('#editUserStatus').val();
					var userFirstname = $('#editUserFirstname').val();
					var userLastname = $('#editUserLastname').val();
					var userRole = $('#editUserRole').val();
					var userEmail = $('#editUserEmail').val();

					if(userName == "") {
						$("#editUserName").after('<p class="text-danger">User Name field is required</p>');
						$('#editUserName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUserName").find('.text-danger').remove();
						// success out for form 
						$("#editUserName").closest('.form-group').addClass('has-success');	  	
					}

					if(userFirstname == "") {
						$("#editUserFirstname").after('<p class="text-danger">First Name field is required</p>');
						$('#editUserFirstname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUserFirstname").find('.text-danger').remove();
						// success out for form 
						$("#editUserFirstname").closest('.form-group').addClass('has-success');	  	
					}
					if(userLastname == "") {
						$("#editUserLastname").after('<p class="text-danger">Last Name field is required</p>');
						$('#editUserLastname').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUserLastname").find('.text-danger').remove();
						// success out for form 
						$("#editUserLastname").closest('.form-group').addClass('has-success');	  	
					}
					if(userRole == "") {
						$("#editUserRole").after('<p class="text-danger">User Role field is required</p>');
						$('#editUserRole').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUserRole").find('.text-danger').remove();
						// success out for form 
						$("#editUserRole").closest('.form-group').addClass('has-success');	  	
					}
					if(userEmail == "") {
						$("#editUserEmail").after('<p class="text-danger">Email field is required</p>');
						$('#editUserEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUserEmail").find('.text-danger').remove();
						// success out for form 
						$("#editUserEmail").closest('.form-group').addClass('has-success');	  	
					}
					if(userStatus == "") {
						$("#editUserStatus").after('<p class="text-danger">User Status field is required</p>');

						$('#editUserStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editUserStatus").find('.text-danger').remove();
						// success out for form 
						$("#editUserStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(userName && userStatus && userRole && userEmail && userFirstname && userLastname) {
						var form = $(this);

						// submit btn
						$('#editUserBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editUserBtn').button('reset');

									// reload the manage member table 
									manageUserTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-user-messages').html('<div class="alert alert-success">'+
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
				}); // /update user form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit users function

function resetUsers(userId = null) {
	if(userId) {
		$('#resetUserId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {userId : userId},
			dataType: 'json',
			success:function(response) {
				$('.resetUserFooter').after('<input type="hidden" name="resetUserId" id="resetUserId" value="'+response.user_id+'" /> ');

				// click on remove button to remove the user
				$("#resetUserBtn").unbind('click').bind('click', function() {
					// button loading
					$("#resetUserBtn").button('loading');

					$.ajax({
						url: 'php_action/resetUser.php',
						type: 'post',
						data: {userId : userId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#resetUserBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#resetMemberModal').modal('hide');

								// reload the user table 
								manageUserTable.ajax.reload(null, false);
								
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
					}); // /ajax function to reset the user password

				}); // /click on reset button to reset the user password

			} // /success
		}); // /ajax

		$('.resetUserFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /reset users function

function removeUsers(userId = null) {
	if(userId) {
		$('#removeUserId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUser.php',
			type: 'post',
			data: {userId : userId},
			dataType: 'json',
			success:function(response) {
				$('.removeUserFooter').after('<input type="hidden" name="removeUserId" id="removeUserId" value="'+response.user_id+'" /> ');

				// click on remove button to remove the user
				$("#removeUserBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeUserBtn").button('loading');

					$.ajax({
						url: 'php_action/removeUser.php',
						type: 'post',
						data: {userId : userId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeUserBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the user table 
								manageUserTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the user

				}); // /click on remove button to remove the user

			} // /success
		}); // /ajax

		$('.removeUserFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove users function