<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	$_SESSION['errors'] = array();
	if (empty($first_name))
	{
		$_SESSION['errors']['first_name'] = "please enter your first name.";
	}
	else
	{
		if (!preg_match("/^[a-zA-Z'-]+$/", $first_name))
		{
			$_SESSION['errors']['first_name'] = "invalid first name";
		}
	}
	if (empty($last_name))
	{
		$_SESSION['errors']['last_name'] = "please enter your last name";
	}
	else
	{
		if (!preg_match("/^[a-zA-Z'-]+$/", $first_name))
		{
			$_SESSION['errors']['last_name'] = "invalid last name";
		}
	}
	if (empty($email_id))
	{
		$_SESSION['errors']['email_id'] = "Please enter your email address";
	}
	else
	{
		if ( ! filter_var($email_id, FILTER_VALIDATE_EMAIL)) 
		{ 
    		$_SESSION['errors']['email_id'] = "Invalid email_id"; 
		}
	}
	if (empty($user_name))
	{
		$_SESSION['errors']['user_name'] = "Please enter your user id";
	}
	if (empty($password))
	{
		$_SESSION['errors']['password'] = "Please enter your password";
	}
	if (empty($confirm_password))
	{
		$_SESSION['errors']['confirm_password'] = "Please confirm your password";
	}
	else
	{
		if($confirm_password != $password)
		{
			$_SESSION['errors']['confirm_password'] = "Password not match.";
		}
	}
	if (empty($address_line1))
	{
		$_SESSION['errors']['address_line1'] = "Please enter your address";
	}
	if (empty($address_line2))
	{
		$_SESSION['errors']['address_line2'] = "Please enter your address";
	}
	if (empty($city))
	{
		$_SESSION['errors']['city'] = "Please enter your city";
	}
	if (empty($zip_code))
	{
		$_SESSION['errors']['zip_code'] = "Please enter your zip code";
	}
	else
	{
		if (!preg_match("/^\d{6}$/", $zip_code))
		{
			$_SESSION['errors']['zip_code'] = "invalid zip code";
		}
	}
	if (empty($state))
	{
		$_SESSION['errors']['state'] = "Please enter your city";
	}
	if (empty($country))
	{
		$_SESSION['errors']['country'] = "Please enter your country";
	}
	if (count($_SESSION['errors']) == 0)
	{
		$check_duplicate = get_row("SELECT user_name, email_id FROM user_data WHERE user_name= '".$user_name ."' or email_id = '".$email_id."'");
		if($check_duplicate == 0)
		{
			$salt = "#asd!&%lkjhgd@@@";
			$hash_password = md5(md5($salt) + md5($password));
			$result = execute_query("INSERT INTO user_data (first_name, last_name, user_name, email_id, password, address_line1, address_line2, city, zip_code, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",array( $first_name, $last_name, $user_name, $email_id, $hash_password, $address_line1, $address_line2, $city, $zip_code, $state, $country));
			echo 'Your entry has been inserted.';
			$_SESSION['data'] = $_POST;
			header('location: ../user_profile.php');	
		}
		else
		{
			$_SESSION['duplicate_user'] = "This email or user name already exist.";
			$_SESSION['data'] = $_POST;
			header('location: ../registration.php');
		}
	}
	else
	{
		$_SESSION['data'] = $_POST;
		header('location: ../registration.php');	
	}
?>