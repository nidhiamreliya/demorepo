<?php
//This includes header of the page
	include('includes/header.php');		
?>
	<!-- Main body of the page -->
	<div class="container-fluid">
		<div class="row">	
			<!-- page header -->
			<div class="form_head">
				<div class="col-md-4 col-md-offset-2">
					<h1>Administrator Panal</h1>
				</div>
				<div class="col-md-3 col-md-offset-2">
					<button value="Log out" class="btn-success btn_logout" name="logout">Log out</button>
				</div>
			</div>
		</div>
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
				echo '<td> ' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['user_name'] . '</td>';
				echo '<td>' . $row['email_id'] . '</td>';
				echo '<td>' . $row['address_line1'] . '</td>';
				echo '<td>' . $row['address_line2'] . '</td>';
				echo '<td>' . $row['city'] . '</td>';
				echo '<td>' . $row['zip_code'] . '</td>';
				echo '<td>' . $row['state'] . '</td>';
				echo '<td>' . $row['country'] . '</td>';
				echo '<td><a href="#">Edit</a></td>';
				echo '<td><a href="#">Delete</a></td>';
				echo '</tr>';
			}
			echo '</table>';
			?>
			</div>
		</div>
	</div>
<?php
	//This includes footer of the page
	include('includes/footer.php');
?>
