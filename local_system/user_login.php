
<?php
	//This is for check errors if any.
	include('includes/session.php');	
	if (isset($_SESSION['error']) && count($_SESSION['error']) > 0)
	{
		$error_message = implode('<br/> ', $_SESSION['error']);
		unset($_SESSION['error']);	
	}
	if (isset($_SESSION['error_id']))
	{		
		$error_id = $_SESSION['error_id'];
		unset($_SESSION['error_id']);
	}
	if (isset($_SESSION['error_password']))
	{		
		$error_password = $_SESSION['error_password'];
		unset($_SESSION['error_password']);
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
			<!-- form header -->
			<div class="form_head text-center">
				<h1>User Login</h1>
			</div>	
			<!-- Form starts -->		
			<form class="form-horizontal reg_form" method="post" action="controllers/ulogin_validation.php">
  				<div class="form-group">
   					<label for="user_name" class="col-md-4 control-label">User name:</label>
   					<div class="col-md-8">
    					<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your user name or email" value="<?=isset($post_data['user_name'])?$post_data['user_name'] : '' ?>">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    				</div>
  				</div>
  				<div>
  					<label for="errors" class="col-md-8  col-md-offset-4 has-error">
	  				<?php
	  					if (isset($error_message))
						{
							echo '<font color=red>' . $error_message . '</font>';
						}
						else 
						{
		  					if (isset($error_id))
							{
								echo '<font color=red>' . $error_id . '</font>';
							}
							else 
							{
								if (isset($error_password))
								{
									echo '<font color=red>' . $error_password . '</font>';	
								}
							}
						}
					?>
					</label>
				</div>
  				<center>
  					<button type="submit" class="btn btn-block btn-success btn_submit">Login</button>
  				<center>
			</form>
		</div>
	</div>

<?php
	//This includes footer of the page
	include('includes/footer.php');
?>

