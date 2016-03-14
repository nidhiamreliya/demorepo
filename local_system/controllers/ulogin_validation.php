<?php
	include('../config/database.php');
	include('../includes/session.php');

	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	} 
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
		$result = get_row("select user_name, email_id, password from user_data where user_name = '".$user_name."' or email_id = '".$user_name."'");
		if($result == 0)
		{
			$_SESSION['error_id'] = "Invalid user name or password.";
			$_SESSION['data'] = $_POST;
			header('location: ../user_login.php');
		}
		else
		{
			$salt = "#asd!&%lkjhgd@@@";
			$hash_password = md5(md5($salt) + md5($password));	

			if( $result['password'] != $hash_password)
			{
				$_SESSION['error_password'] = "Invalid password";
				$_SESSION['data'] = $_POST;
				header('location: ../user_login.php');
			}
			else
			{	
				$_SESSION['user'] = $_POST['user_name'];
				header('location: ../user_profile.php');
			}
		}
	}	
?>