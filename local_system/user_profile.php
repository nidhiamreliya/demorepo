
<?php
  //To retrive data form registration or login
 	include('includes/session.php');
    $post_data = array();
    $error_message = array(); 
	if (isset($_SESSION['upload_error']) && count($_SESSION['upload_error']) > 0)
	{
  		$error_message = $_SESSION['upload_error'];
    	unset($_SESSION['upload_error']); 
  	}
  	if(isset($_GET['id']))
  	{
  		$_SESSION['user'] = $_GET['id'];
  		unset($_GET['id']);
  	}
    if (isset($_SESSION['user']))
    {
  		$user = $_SESSION['user'];
		//This includes header of the page
		include('includes/header.php');
		$post_data = get_row("select first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country, profile_pic from user_data where user_name = ? or email_id = ?", array($user, $user));
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
   	<div class="row">
      <div class="form_head text-center">
      	<div class="col-md-4">
			<h1>Welcome <? if(isset($_SESSION['user'])) { echo $_SESSION['user']; } ?></h1>
		</div>
		<div class="col-md-3 col-md-offset-2 text-right">
			<a value="Log out" class=" btn btn-success btn_logout"  name="logout" href="controllers/log_out.php">Log out</a>
		</div>
      </div>  
    </div>
	 	<div class="row">
			<!-- Form starts -->	
			<!-- Form left -->	
			<form class="form-horizontal reg_form col-md-3 col_profil_pic text-center" method="post" action="controllers/edit_userprofile.php" enctype="multipart/form-data">
	         	<div class="text-center form_group">
	            	<img src="user_profiles/<? if($post_data['profile_pic'] != null) { echo $post_data['profile_pic']; } else { echo "default_profile.jpg"; }?>"  class="profile_pic" alt="Profile not set">
	            	<h6>Upload a different photo...</h6>
	            	<input type="file" name="profile_pic" class="form-control" id="profile_pic">
	 				<input type="submit" value="Upload Image" class="form-control btn btn-success" name="img_submit">
	 				<span class="error_class">
	 				<?php 
                		if(isset($error_message)) 
               			{
                   			foreach ($error_message as $key) 
                   			{
                   				echo $key ."<br/>";
                   			}
                		}
              		?>
              		</span>
		   		</div>
			</form>
			<!-- Form right-->
		   	<div class="col-md-6"> 
	        		<form class="form-horizontal reg_form" method="post" action="controllers/edit_userprofile.php"> 
		  				<div class="form-group">
		   					<label for="first_name" class="col-md-4 control-label">First name:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="first_name" placeholder="First name" value="<?=isset($post_data['first_name']) ? $post_data['first_name']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="last_name" class="col-md-4 control-label">Last name:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="last_name" placeholder="Last name" value="<?=isset($post_data['last_name']) ? $post_data['last_name']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="email_id" class="col-md-4 control-label">E-mail:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="email_id" placeholder="Example@Email.com" disabled value="<?=isset($post_data['email_id']) ? $post_data['email_id']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="user_name" class="col-md-4 control-label">User name:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="user_name" placeholder="User name" disabled value="<?=isset($post_data['user_name']) ? $post_data['user_name']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="password" class="col-md-4 control-label">Password:</label>
		   					<div class="col-md-8">
		    				<input type="password" class="form-control" id="password" placeholder="Password" >
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="address_line1" class="col-md-4 control-label">Address:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="address_line1" placeholder="Address line1" value="<?=isset($post_data['address_line1']) ? $post_data['address_line1']: ''?>">
		    				</div>
		    			</div>
		    			<div class="form-group">
		    				<div class="col-md-8 col-md-offset-4">
		    				<input type="text" class="form-control" id="address_line2" placeholder="Address line2" value="<?=isset($post_data['address_line2']) ? $post_data['address_line2']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="city" class="col-md-4 control-label">City:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="city" placeholder="City" value="<?=isset($post_data['city']) ? $post_data['city']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="Zip_code" class="col-md-4 control-label">Zip Code:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="zip_code" placeholder="Zip-code" value="<?=isset($post_data['zip_code']) ? $post_data['zip_code']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
		   					<label for="state" class="col-md-4 control-label">State:</label>
		   					<div class="col-md-8">
		    				<input type="text" class="form-control" id="state" placeholder="State" value="<?=isset($post_data['state']) ? $post_data['state']: ''?>">
		    				</div>
		  				</div>
		  				<div class="form-group">
	   						<label for="country" class="col-md-4 control-label">Country:</label>
	   						<div class="col-md-8">
	    					<input type="text" class="form-control" id="country" placeholder="Country" value="<?=isset($post_data['country']) ? $post_data['country']: ''?>">
	    					</div>
	  					</div>
	  					<center>
	  						<button type="submit" class="btn btn-success btn_submit" name="submit">Edit</button>
	  					</center>
					</form>
	    	</div>
		</div>
	</div>
<?php
  }
  else
  {
    header('location: user_login.php');
  }
	//This includes footer of the page
	include('includes/footer.php');
?>

