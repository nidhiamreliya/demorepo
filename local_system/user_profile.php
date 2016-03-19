
<?php
	include('includes/session.php');
	// Check if any errors in submitting form.
    $upload_message = array(); 
	if (isset($_SESSION['upload_error']) && count($_SESSION['upload_error']) > 0)
	{
		$upload_message = $_SESSION['upload_error'];
	 	unset($_SESSION['upload_error']); 
	}
	if (isset($_SESSION['duplicate_user']))
  	{
    	$duplicate_user = $_SESSION['duplicate_user'];
    	unset($_SESSION['duplicate_user']);
  	}
	$error_message = array(); 
  	if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0)
  	{
    	$error_message =  $_SESSION['errors'];
    	unset($_SESSION['errors']); 
  	}
  	//check authenticatin
  	include('controllers/check_authentication.php');
	if(isset($_GET['id']))
	{
		if ($_GET['id'] == "")
		{
			header('location: admin_panal.php');
		}
		$edit_user = $_GET['id'];
		unset($_GET['id']);
	}
	else if(isset($_SESSION['edit_user']))
	{
		$edit_user = $_SESSION['edit_user'];
	}
	else
	{
		$edit_user = $_SESSION['user_id'];
	}
	// This includes header of the page
	include('includes/header.php');
	$post_data = array();
	$post_data = get_row("select user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country, profile_pic from user_data where user_id = ? ", array($edit_user));
?>
		<!-- Main body of the page -->
		<div class="container-fluid">
		<!-- Header of page -->
	   	<div class="row">
		    <div class="form_head text-center">
		      	<div class="col-md-4">
					<h1>Welcome 
						<?php
							if(isset($post_data['first_name'])) 
							{
								echo $post_data['first_name']; 
							} 
						?>
					</h1>
				</div>
				<div class="col-md-3 col-md-offset-3 text-right">
					<ul class="nav nav-pills">
  						<li role="presentation"><a value="Log out" class="btn-success btn_head" name="logout" href="controllers/log_out.php">Log out</a></li>
  						<li role="presentation"><a value="back" class="btn-success btn_head"  name="back" href="<?php if($_SESSION['privilege'] == 2) { echo "admin_panel.php"; } else { echo "controllers/log_out.php"; } ?>">Back</a></li>
					</ul>				
				</div>
		    </div>  
	    </div>
	    <!--  Middle Body of the page -->
		 	<div class="row">	
				<!-- Form for update user profile picture -->	
				<form class="form-horizontal reg_form col-md-3 col_profil_pic text-center" method="post" action="controllers/user_profile.php" enctype="multipart/form-data">
					<div class="text-center form_group">
		         		<img src="user_profiles/<? if($post_data['profile_pic'] != null) { echo $post_data['profile_pic']; } else { echo "default_profile.jpg"; }?>"  class="profile_pic" alt="Profile not set">
		            	<h6>Upload a different photo...</h6>
		            	<input type="file" name="profile_pic" class="form-control" id="profile_pic">
		 				<input type="submit" value="Upload Image" class="form-control btn btn-success" name="img_submit">
		 				<input type="hidden" name="edit_user_id" id="edit_user_id" value="<?=isset($post_data['user_id']) ? $post_data['user_id'] : ''?>">
		 				<span class="error_class">
			 				<?php 
		                		if(isset($upload_message)) 
		               			{
		                  			foreach ($upload_message as $key) 
		                   			{
		                   				echo $key ."<br/>";
		                   			}
		                		}
		           	  		?>
	              		</span>
			   		</div>
				</form>
				<!-- Form for update user information -->
			   	<div class="col-md-6"> 
		        	<form class="form-horizontal reg_form" method="post" action="controllers/user_profile.php" name="edit_profile" onsubmit="return edit_validation()"> 
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
	   					<label for="first_name" class="col-md-4 control-label">First name:</label>
	   					<div class="col-md-8">
	   						<input type="hidden" name="edit_user_id" id="edit_user_id" value="<?=isset($post_data['user_id']) ? $post_data['user_id'] : 'NOT ANYTHING'?>">
	    					<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="<?=isset($post_data['first_name']) ? $post_data['first_name']: ''?>">
	    					<label class="col-md-8 error_class">
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
	   						<label for="last_name" class="col-md-4 control-label">Last name:</label>
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
   							<label for="email_id" class="col-md-4 control-label">E-mail:</label>
   							<div class="col-md-8">
    							<input type="text" class="form-control" id="email_id" name="email_id" <?if($_SESSION['privilege']==1) { echo "disabled"; }else{ echo "enabled";} ?> placeholder="Example@Email.com" value="<?=isset($post_data['email_id']) ? $post_data['email_id']: ''?>">
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
	   						<label for="user_name" class="col-md-4 control-label">User name:</label>
	   						<div class="col-md-8">
		    					<input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" <?if($_SESSION['privilege']==1) { echo "disabled"; }else{ echo "enabled";} ?> value="<?=isset($post_data['user_name']) ? $post_data['user_name']: ''?>">
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
		   					<label for="password" class="col-md-4 control-label">Password:</label>
		   					<div class="col-md-8">
		    					<input type="password" class="form-control" id="password" name="password" placeholder="Password" >
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
 								<input type="password" class="form-control" id="confirm_password" name="confirm_password"placeholder="Confirm password">
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
		   					<label for="address_line1" class="col-md-4 control-label">Address:</label>
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
		   					<label for="city" class="col-md-4 control-label">City:</label>
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
		   					<label for="Zip_code" class="col-md-4 control-label">Zip Code:</label>
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
		   					<label for="state" class="col-md-4 control-label">State:</label>
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
	   						<label for="country" class="col-md-4 control-label">Country:</label>
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
	  					<center>
	  						<button type="submit" class="btn btn-success btn_submit" name="submit">Edit</button>
	  					</center>
					</form>
		    	</div>
			</div>
		</div>
<?php
	//This includes footer of the page
	include('includes/footer.php');
?>

