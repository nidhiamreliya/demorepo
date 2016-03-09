
<?php
	//This includes header of the page
	include('includes/header.php');
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
    <div class="row">
      <div class="form_head text-center">
        <h1>User name</h1>
      </div>  
    </div>
    <div clas="row">
      <div class="col-md-3 col_profil_pic">
            <div class="text-center col-md-offset-3">
              <img src="images/default_profile.jpg"  class="profile_pic" alt="Profile not set">
              <h6>Upload a different photo...</h6>
              <input type="file" class="form-control text-center">
            </div>
      </div>
		  <div class="col-md-6">				
			<!-- Form starts -->	
			<form class="form-horizontal reg_form">
  				<div class="form-group">
   					<label for="first_name" class="col-md-4 control-label">First name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="first_name" placeholder="Firt name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="last_name" class="col-md-4 control-label">Last name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="last_name" placeholder="Last name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="email_id" class="col-md-4 control-label">E-mail:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="email_id" placeholder="Example@Email.com" disabled>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="user_name" class="col-md-4 control-label">User name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="user_name" placeholder="User name" disabled>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    				<input type="password" class="form-control" id="password" placeholder="password">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="address_line1" class="col-md-4 control-label">Address:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="address_line1" placeholder="Address line1">
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="col-md-8 col-md-offset-4">
    				<input type="text" class="form-control" id="address_line2" placeholder="Address line2">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="city" class="col-md-4 control-label">City:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="city" placeholder="City">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Zip_code" class="col-md-4 control-label">Zip Code:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="zip_code" placeholder="Zip-code">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="state" class="col-md-4 control-label">State:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="state" placeholder="State">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="country" class="col-md-4 control-label">Country:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="country" placeholder="Country">
    				</div>
  				</div>
  				<center>
  				<button type="submit" class="btn btn-success btn_submit">Edit</button>
  				</center>
			</form>
		  </div>
    </div>
	</div>

<?php
	//This includes footer of the page
	include('includes/footer.php');
?>

