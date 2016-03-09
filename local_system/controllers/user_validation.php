<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	
	$result = execute_query("INSERT INTO user_data (first_name, last_name, user_name, email_id, password, address_line1, address_line2, city, zip_code, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",array( $first_name, $last_name, $user_name, $email_id, $password, $address_line1, $address_line2, $city, $zip_code, $state, $country));
	echo 'Your entry has been inserted.';	

?>