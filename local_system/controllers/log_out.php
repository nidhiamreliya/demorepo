<?php
	include('../includes/session.php');
	unset($_SESSION['user_id']);
	unset($_SESSION['privilege']);
	unset($_SESSION['edit_user']);
	header('location: ../user_login.php');
?>