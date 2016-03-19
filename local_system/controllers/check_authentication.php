<?php
	include('config/globals.php');
	if(isset($_SESSION['user_id']) && isset($_SESSION['privilege']))
	{
		if($_SESSION['privilege'] == 1)
		{
			if(!in_array(basename($_SERVER['REQUEST_URI']), $end_user))
			{
				header('location: user_login.php');
			}
		}
		else if($_SESSION['privilege'] == 2)
		{
			if(strpos(basename($_SERVER['REQUEST_URI']), '?'))
			{
				$url= substr(basename($_SERVER['REQUEST_URI']), 0, strpos(basename($_SERVER['REQUEST_URI']), "?"));
				if(!in_array($url, $admin))
				{
					header('location: user_login.php');
				}
			}
			else if(!in_array(basename($_SERVER['REQUEST_URI']), $admin))
			{
				header('location: user_login.php');
			}
		}
	}
	else
	{
		header('location: user_login.php');
	}
?>