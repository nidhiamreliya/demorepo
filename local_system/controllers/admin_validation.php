<?php
	include('../config/database.php');
	include('../includes/session.php');

	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	} 
	$_SESSION['error'] = array();
	if(empty($admin_id))
	{
		$_SESSION['error'][] = "Please provide your user name..";
	}
	if(empty($password))
	{
		$_SESSION['error'][] = "Please provide your password..";
	}
	if(count($_SESSION['error']) == 0)
	{
		$result = get_row("select admin_id, admin_password from admin_data where admin_id = '".$admin_id."'");
		if($result == 0)
		{
			$_SESSION['error_id'] = "Invalid user name or password.";
			$_SESSION['data'] = $_POST;
			header('location: ../admin_login.php');
		}
		else
		{
			$salt = "#asd!&%lkjhgd@@@";
			$hash_password = md5(md5($salt) + md5($password));	
			echo $hash_password;
			if( $result['admin_password'] != $hash_password)
			{
				$_SESSION['error_password'] = "Invalid password";
				$_SESSION['data'] = $_POST;
				header('location: ../admin_login.php');
			}
			else
			{	
				$_SESSION['data'] = $post_data;
				header('location: ../admin_panal.php');
			}
		}
	}
?>