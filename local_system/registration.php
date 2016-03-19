<?php
  //This is for check errors in submitting form.
  include('includes/session.php'); 
  $error_message = array(); 
  if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
  {
    $error_message =  $_SESSION['errors'];
    unset($_SESSION['errors']); 
  }
  if (isset($_SESSION['duplicate_user']))
  {
    $duplicate_user = $_SESSION['duplicate_user'];
    unset($_SESSION['duplicate_user']);
  }
  $post_data = array();
  if (isset($_SESSION['data']))
  {
    $post_data = $_SESSION['data'];
    unset($_SESSION['data']); 
  }
	//This includes header of the page
	include('includes/header.php');
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<!-- Page header -->
			<div class="form_head text-center">
				<h1>Registration Form</h1>
			</div>	
			<!-- Registration form -->	
			<form class="form-horizontal reg_form" method="post" action="controllers/registration.php" name="registration" id="registration" onsubmit = "return form_validation()">
  				<div>
            <label class="col-md-8 col-md-offset-4 error_class">
              <?php 
                 if(isset($duplicate_user)) 
                 {
                    echo $duplicate_user;
                  }
              ?>
             </label>
          </div>
          <div class="form-group">
   					<label for="first name" class="col-md-4 control-label">First name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?=isset($post_data['first_name']) ? $post_data['first_name']: ''?>">
            <label class="col-md-8 has-error error_class">
              <?php 
                if(isset($error_message['first_name'])) 
                {
                   echo $error_message['first_name'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="last name" class="col-md-4 control-label">Last name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="<?=isset($post_data['last_name']) ? $post_data['last_name']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['last_name'])) 
                {
                   echo $error_message['last_name'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="email id" class="col-md-4 control-label">E-mail:</label>
   					<div class="col-md-8">
    				<input type="email" class="form-control" id="email_id" name="email_id" placeholder="Example@Email.com" value="<?=isset($post_data['email_id']) ? $post_data['email_id']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['email_id'])) 
                {
                   echo $error_message['email_id'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="user name" class="col-md-4 control-label">User name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" value="<?=isset($post_data['user_name']) ? $post_data['user_name']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['user_name'])) 
                {
                   echo $error_message['user_name'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    				<input type="password" class="form-control" id="password"  name="password" placeholder="Password">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['password'])) 
                {
                   echo $error_message['password'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="confirm password" class="col-md-4 control-label">Confirm Password:</label>
   					<div class="col-md-8">
    				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
    				<label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['confirm_password'])) 
                {
                   echo $error_message['confirm_password'];
                }
              ?>
            </label>
            </div>
  				</div>
  				<div class="form-group">
   					<label for="address line1" class="col-md-4 control-label">Address:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Address line1" value="<?=isset($post_data['address_line1']) ? $post_data['address_line1']: ''?>">
    				<label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['address_line1'])) 
                {
                   echo $error_message['address_line1'];
                }
              ?>
            </label>
            </div>
    			</div>
    			<div class="form-group">
    				<div class="col-md-8 col-md-offset-4">
    				<input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Address line2" value="<?=isset($post_data['address_line2']) ? $post_data['address_line2']: ''?>">
    				<label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['address_line2'])) 
                {
                   echo $error_message['address_line2'];
                }
              ?>
            </label>
            </div>
  				</div>
  				<div class="form-group">
   					<label for="City" class="col-md-4 control-label">City:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?=isset($post_data['city']) ? $post_data['city']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['city'])) 
                {
                   echo $error_message['city'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Zip code" class="col-md-4 control-label">Zip Code:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip-code" value="<?=isset($post_data['zip_code']) ? $post_data['zip_code']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['zip_code'])) 
                {
                   echo $error_message['zip_code'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="State" class="col-md-4 control-label">State:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="state" name="state" placeholder="State" value="<?=isset($post_data['state']) ? $post_data['state']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['state'])) 
                {
                   echo $error_message['state'];
                }
              ?>
            </label>
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="Country" class="col-md-4 control-label">Country:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?=isset($post_data['country']) ? $post_data['country']: ''?>">
            <label class="col-md-8 error_class">
              <?php 
                if(isset($error_message['country'])) 
                {
                   echo $error_message['country'];
                }
              ?>
            </label>
    				</div>
  				</div>
          <div class="text-center col-md-8 col-md-offset-4">
  				<button type="submit" class="btn btn-block btn-success btn_submit">Submit</button>
          </div>
			</form>
		</div>
	</div>
<?php
	//This includes footer of the page
	include('includes/footer.php');
?>

