<?php
	include('includes/session.php');
	include('config/database.php');

	if(isset($_GET['id']))
	{
		$result = execute_query("DELETE FROM user_data where user_name= ?", array($_GET['id']));
		$_SESSION['message'] = $_GET['id'] . " has been removed."; 
	}
	header('location: admin_panal.php');
?>