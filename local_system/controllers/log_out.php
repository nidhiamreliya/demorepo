<?php
	include('../includes/session.php');
	// Unset all sessions on click of logout button
	unset($_SESSION['user_id']);
	unset($_SESSION['privilege']);
	unset($_SESSION['edit_user']);
	header('location: ../user_login.php');
?>