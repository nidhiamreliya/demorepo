<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	if(isset($profile_pic))
	{
		echo $profile_pic;
		if(exif_imagetype ($profile_pic) == IMAGETYPE_PNG)
		{
			echo "its an image";
		}
		else
		{
			echo "its not an image";
		}
	}

	//header('location: ../registration.php');	
	
?>