
<?php
	//This includes header of the page
	include('includes/header.php');
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<!-- form header -->
			<div class="form_head text-center">
				<h1>Administrator Login</h1>
			</div>	
			<!-- Form starts -->	
			<form class="form-horizontal reg_form" method="post" action="controllers/admin_validation.php">
  				<div class="form-group">
   					<label for="admin_name" class="col-md-4 control-label">User name:</label>
   					<div class="col-md-8">
    				<input type="text" class="form-control" id="admin_id" name="admin_id" placeholder="User name">
    				</div>
  				</div>
  				<div class="form-group">
   					<label for="password" class="col-md-4 control-label">Password:</label>
   					<div class="col-md-8">
    				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
    				</div>
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

