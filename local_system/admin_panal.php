<?php
//To retrive data form registration or login
  include('includes/session.php');
  $post_data = array();
  if (isset($_SESSION['admin']))
  {  
  	if(isset($_SESSION['message']))
  	{
  		$message = $_SESSION['message'];
  		unset($_SESSION['message']);
  	}
	//This includes header of the page
	include('includes/header.php');		
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="row">	
			<!-- page header -->
			<div class="form_head">
				<div class="col-md-4 col-md-offset-2">
					<h1>Welcome <? if(isset($_SESSION['admin'])) { echo $_SESSION['admin']; } ?></h1>
				</div>
				<div class="col-md-3 col-md-offset-2">
					<a value="Log out" class=" btn btn-success btn_logout"  name="logout" href="controllers/log_out.php">Log out</a>
				</div>
			</div>
		</div>
		<!-- page body -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<?php
			$user_data = get_rows("SELECT first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country FROM user_data");
			
			echo '<table class="table-striped col-md-12 table-bordered table-responsive">';
			echo '<tr>';
			echo '<th>First name</th>';
			echo '<th>Last name</th>';
			echo '<th>User name</th>';
			echo '<th>Email id</th>';
			echo '<th colspan=2>Address</th>';
			echo '<th>City</th>';
			echo '<th>Zip code</th>';
			echo '<th>State</th>';
			echo '<th>Country</th>';
			echo '<th>Edit</th>';
			echo '<th>Delete</th>';
			echo '</tr>';
			foreach ($user_data as $row)
			{
				echo '<tr>';
				echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['user_name'] . '</td>';
				echo '<td>' . $row['email_id'] . '</td>';
				echo '<td>' . $row['address_line1'] . '</td>';
				echo '<td>' . $row['address_line2'] . '</td>';
				echo '<td>' . $row['city'] . '</td>';
				echo '<td>' . $row['zip_code'] . '</td>';
				echo '<td>' . $row['state'] . '</td>';
				echo '<td>' . $row['country'] . '</td>';
				echo '<td><a href=\'user_profile.php?id='.$row['user_name'].'\'>Edit</a></td>';
				echo '<td><a href=\'delete_user.php?id='.$row['user_name'].'\'>Delete</a></td>';
				echo '</tr>';
			}
			echo '</table>';
			?>
			</div>
		</div>
		<div class="row">
			<span class="col-md-6 col-md-offset-3 text-center alert-success" >
				<?php
					if(isset($message))
					{
						echo '<strong>' . $message . '</strong>';
					}
				?>
			</span>
		</div>
	</div>
<?php
	}
  	else
  	{
    	header('location: admin_login.php');
  	}
	//This includes footer of the page
	include('includes/footer.php');
?>
