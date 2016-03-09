
<?php
	//This includes header of the page
	include('includes/header.php');
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<!-- form header -->
			<div class="form_head text-center">
				<h1>Registration Form</h1>
			</div>	
			<!-- Form starts -->	
			<form class="form-horizontal reg_form" method="post" action="controllers/user_validation.php">
  				<div class="form-group">
   					<label for="first name" class="col-md-4 control-label">First name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Firt name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="last name" class="col-md-4 control-label">Last name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="email id" class="col-md-4 control-label">E-mail:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="email_id" name="email_id" placeholder="Example@Email.com">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="user name" class="col-md-4 control-label">User name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    				<input type="password" class="form-control" id="password"  name="password" placeholder="password">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="confirm password" class="col-md-4 control-label">Confirm Password:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="confirm_password" name="confirm_password"placeholder="Confirm password">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="address line1" class="col-md-4 control-label">Address:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address line1">
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="col-md-8 col-md-offset-4">
    				<input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address line2">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="City" class="col-md-4 control-label">City:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="city" name="city" placeholder="City">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Zip code" class="col-md-4 control-label">Zip Code:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip-code">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="State" class="col-md-4 control-label">State:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="state" name="state" placeholder="State">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Country" class="col-md-4 control-label">Country:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="country" name="country" placeholder="Country">
    				</div>
  				</div>
  				<center>
  				<button type="submit" class="btn btn-block btn-success btn_submit">Submit</button>
  				<center>
			</form>
		</div>
	</div>

<?php
	//This includes footer of the page
	include('includes/footer.php');
?>

