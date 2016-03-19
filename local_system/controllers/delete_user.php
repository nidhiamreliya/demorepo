<?php
	include('../includes/session.php');
	include('../config/database.php');
	//check autentication 
	include('check_authentication.php');
	//Delete user as requested by admin
	if($_GET['id'] == "" || $_GET['id'] <= 2)
	{
		$_SESSION['message'] = "Sorry you can not delete this user."; 
		header('location: ../admin_panel.php');
	}
	else
	{
		$result = execute_query("DELETE FROM user_data where user_id= ?", array($_GET['id']));
		$_SESSION['message'] = "Record has been removed."; 
	}
	header('location: ../admin_panel.php');
?>