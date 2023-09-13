<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">User</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage User</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
								
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addUserModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add User </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageUserTable">
					<thead>
						<tr>							
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>E-mail</th>
							<th>User Role</th>
							<th>Last Login</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addUserModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitUserForm" name="userform" action="php_action/createUser.php" method="POST" onsubmit="return checkForm(this)">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-plus"></i>  Add User</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-user-messages"></div>

	        <div class="form-group">
	        	<label for="userFirstname" class="col-sm-4 control-label">First Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="userFirstname" placeholder="First Name" name="userFirstname" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="userLastname" class="col-sm-4 control-label">Last Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter characters only!" type="text" pattern="^[A-Za-z]+" class="form-control" id="userLastname" placeholder="Last Name" name="userLastname" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

			<div class="form-group">
	        	<label for="userName" class="col-sm-4 control-label">Username: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Username contain only letters, numbers and underscores." type="text"  pattern="\w+" class="form-control" id="userName" placeholder="Username" name="userName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="userPassword" class="col-sm-4 control-label">Password: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" type="password" class="form-control" id="userPassword" placeholder="Password" name="userPassword" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.userConfirmpassword.pattern =RegExp.escape(this.value);" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="userConfirmpassword" class="col-sm-4 control-label">Confirm Password: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Confirm password must be the same with the above password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" class="form-control" id="userConfirmpassword" placeholder="Confirm Password" name="userConfirmpassword" onchange="  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="userEmail" class="col-sm-4 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Please insert appropriate email address" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="userEmail" placeholder="E-mail" name="userEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        <div class="form-group">
	        	<label for="userRole" class="col-sm-4 control-label">User Role: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select type="text" class="form-control" id="userRole" placeholder="User Role" name="userRole" >
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT user_role_id, user_role, user_role_status FROM user_role WHERE user_role_status = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        
				<div class="form-group">
	        	<label for="userStatus" class="col-sm-4 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="userStatus" name="userStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Active</option>
				      	<option value="2">Inactive</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUserBtn" onclick="checkValidity()" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit user -->
<div class="modal fade" id="editUserModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editUserForm" action="php_action/editUser.php" method="POST" onsubmit="return checkForm();">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="fa fa-edit"></i>   Edit User Role</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-user-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-user-result">
		      	<div class="form-group">
	        	<label for="editUserFirstname" class="col-sm-4 control-label">First Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="editUserFirstname" placeholder="First Name" name="editUserFirstname" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->
				<div class="form-group">
	        	<label for="editUserLastname" class="col-sm-4 control-label">Last Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Enter characters only!" type="text" pattern="^[A-Z a-z]+" class="form-control" id="editUserLastname" placeholder="Last Name" name="editUserLastname" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->

				<div class="form-group">
	        	<label for="editUserName" class="col-sm-4 control-label">Username: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Username contain only letters, numbers and underscores." type="text"  pattern="\w+" class="form-control" id="editUserName" placeholder="Username" name="editUserName" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->	
				<div class="form-group">
	        	<label for="editUserEmail" class="col-sm-4 control-label">E-mail: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input title="Please insert appropriate email address" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="editUserEmail" placeholder="E-mail" name="editUserEmail" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->
				<div class="form-group">
	        	<label for="editUserRole" class="col-sm-4 control-label">User Role: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select type="text" class="form-control" id="editUserRole" placeholder="User Role" name="editUserRole" >
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT user_role_id, user_role, user_role_status FROM user_role WHERE user_role_status = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
				</div> <!-- /form-group-->
				<div class="form-group">
	        	<label for="editUserStatus" class="col-sm-4 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="editUserStatus" name="editUserStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Active</option>
				      	<option value="2">Inactive</option>
				      </select>
				    </div>
				</div> <!-- /form-group-->
		      </div>         	        
		      <!-- /edit user result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editUserFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit user -->

<!-- reset user -->
<div class="modal fade" tabindex="-1" role="dialog" id="resetMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Reset User Password</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to reset password ?</p>
      </div>
      <div class="modal-footer resetUserFooter">
        <button type="button" class="btn btn-primary" id="resetUserBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /reset user -->

<!-- remove user -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"> <i class="glyphicon glyphicon-trash"></i> Remove User</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeUserFooter">
        <button type="button" class="btn btn-primary" id="removeUserBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove user -->

<!--<script type="text/javascript">

  function checkForm(form)
  {
    re = /^\w+$/;
    if(!re.test(form.userName.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    } 

    if(form.userPassword.value != "" && form.userPassword.value == form.userConfirmpassword.value) {
      if(form.userPassword.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        form.userPassword.focus();
        return false;
      }
      if(form.userPassword.value == form.userName.value) {
        alert("Error: Password must be different from Username!");
        form.userPassword.focus();
        return false;
      }
	  if(form.userPassword.value != form.userConfirmpassword.value) {
        alert("Error: Password must be the same with confirmed password!");
        form.userPassword.focus();
        return false;
      }
      re = /[0-9]/;
      if(!re.test(form.userPassword.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        form.userPassword.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(form.userPassword.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        form.userPassword.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(form.userPassword.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        form.userPassword.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.userPassword.focus();
      return false;
    }

    alert("You entered a valid password: " + form.userPassword.value);
    return true;
  }

</script> -->
<!--<script src="custom/js/Character.js"></script>-->
<script src="custom/js/user.js"></script>
<?php require_once 'includes/footer.php'; ?>