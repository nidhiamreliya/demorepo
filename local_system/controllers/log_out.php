<?php
	include('../includes/session.php');
	unset($_SESSION['user_id']);
	unset($_SESSION['privilege']);
	header('location: ../user_login.php');
?>