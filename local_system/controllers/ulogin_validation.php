<?php
	include('../config/database.php');
	include('../includes/session.php');

	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	} 
	print_r($_POST);
	$_SESSION['error'] = array();
	if(empty($user_name))
	{
		$_SESSION['error'][] = "Please provide your user name or email..";
	}
	if(empty($password))
	{
		$_SESSION['error'][] = "Please provide your password..";
	}

	if(count($_SESSION['error']) == 0)
	{
		
		$result = get_row("select user_name, email_id, password from user_data where user_name = '?' or email_id = '?'", array($user_name,$user_name));
		if($user_name != $result["user_name"] || $user_name != $result["email_id"])
		{
			$_SESSION['error_id'] = "Invalid user name.";
		}
		if($password != $result["password"])
		{
			$_SESSION['error_password'] = "Invalid password";
		}
	}
	$_SESSION['data'] = $_POST;
		
	header('location: ../user_login.php');
?>