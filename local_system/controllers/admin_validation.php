<?php
	include('../config/database.php');

	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	} 
	$error = array();
	if(empty($admin_id))
	{
		$error = "*";
	}
	if(empty($password))
	{
		$error = "*";
	}
	if($error == 0)
	{
		echo "there are some empty fields";
	}
	else
	{
		$result = get_row("select admin_id, admin_password from admin_data");
		if($_POST["admin_id"] != $result["admin_id"])
		{
			echo "invalid id";
		}
		if($_POST["password"] != $result["admin_password"])
		{
			echo "invalid password";
		}
	}
?>