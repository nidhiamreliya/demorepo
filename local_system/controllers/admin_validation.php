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
		$result = get_row("select admin_id, admin_password from admin_data");
		if($admin_id != $result["admin_id"])
		{
			$_SESSION['error_id'] = "Invalid user name.";
		}
		if($password != $result["admin_password"])
		{
			$_SESSION['error_password'] = "Invalid password";
		}
	}
	$_SESSION['data'] = $_POST;
	
	header('location: ../admin_login.php');
?>