<?php
  //To retrive data form registration or login
  include('includes/session.php');
  if ($_SESSION['privilege'] == 2 )
  {  
  	if(isset($_SESSION['message']))
  	{
  		$message = $_SESSION['message'];
  		unset($_SESSION['message']);
  	}
  }
  else
  {
   	header('location: user_login.php');
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
					<h1>Welcome Admin</h1>
				</div>
				<div class="col-md-3 col-md-offset-2">
					<ul class="nav nav-pills">
  						<li role="presentation"><a value="Log out" class="btn-success btn_head" name="logout" href="controllers/log_out.php">Log out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- page body -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<?php
			$user_data = get_rows("SELECT user_id, first_name, last_name, user_name, email_id, address_line1, address_line2, city, zip_code, state, country FROM user_data");
			
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
				echo '<td><a href=\'user_profile.php?id='.$row['user_id'].'\'>Edit</a></td>';
				if($row['user_id'] == $_SESSION['user_id'])
				{
					echo '<td>&nbsp</td>';
				}
				else
				{
					echo '<td><a onclick="return confirm(\'Are you Sure you want to delete ' . $row['first_name'] . '!\');" href=\'controllers/delete_user.php?id='.$row['user_id'].'\' >Delete</a></td>';
				}
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
	//This includes footer of the page
	include('includes/footer.php');
?>
