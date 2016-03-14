<?php
	include('../includes/session.php');
	if(isset($_SESSION['user']))
	{
		unset($_SESSION['user']);
		unset($_SESSION['data']);
		header('location: ../user_login.php');
	}
	if(isset($_SESSION['admin']))
	{
		unset($_SESSION['admin']);
		header('location: ../admin_login.php');
	}

?>