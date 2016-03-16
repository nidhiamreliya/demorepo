<?php
	include('../includes/session.php');
	include('../config/database.php');

	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	//Update profile picture
	$target_dir = "/var/www/local_system/user_profiles/";
	$imageFileType = pathinfo($_FILES["profile_pic"]["name"],PATHINFO_EXTENSION);
	$target_file = $target_dir . $edit_user_id . "." . $imageFileType ;
	echo $target_file ;
	$_SESSION['upload_error'] = array();
	// Check if image file is a actual image or fake image
	if(isset($_POST["img_submit"])) 
	{
	   	$check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    	if($check === false) 
    	{
        	$_SESSION['upload_error'][] = "File is not an image.";
    	}
		// Check if file already exists
		if (file_exists($target_file)) 
		{
		   unlink($target_file);
		}
		// Check file size
		if ($_FILES["profile_pic"]["size"] > 700000) 
		{
		   $_SESSION['upload_error'][] = "Sorry, your file is too large.";
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
			$_SESSION['upload_error'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
		// Check if there is any error
		if (count($_SESSION['upload_error']) != 0) 
		{
			$_SESSION['upload_error'][] = "Sorry, your file was not uploaded.";
			$_SESSION['edit_user'] = $edit_user_id;
			header('location: ../user_profile.php');
		} 
		else 
		{
		   if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) 
		   {
		   	$result = execute_query("UPDATE user_data SET  profile_pic = '". $edit_user_id . "." . $imageFileType . "' WHERE user_id = '".$edit_user_id."'");
		    	$_SESSION['edit_user'] = $edit_user_id;
		    	header('location: ../user_profile.php');	
		   } 
		   else 
		   {
	      	echo "Sorry, there was an error uploading your file." . '<br/>';
	    	}
		}
	}
	// Update user profile
	if(isset($_POST["submit"])) 
	{
		$_SESSION['errors'] = array();
		if (empty($first_name))
		{
			$_SESSION['errors']['first_name'] = "please enter your first name.";
		}
		else
		{
			if (!preg_match("/^[a-zA-Z'-]+$/", $first_name))
			{
				$_SESSION['errors']['first_name'] = "invalid first name";
			}
		}
		if (empty($last_name))
		{
			$_SESSION['errors']['last_name'] = "please enter your last name";
		}
		else
		{
			if (!preg_match("/^[a-zA-Z'-]+$/", $last_name))
			{
				$_SESSION['errors']['last_name'] = "invalid last name";
			}
		}
		if($_SESSION['privilege'] == 2)
		{
			if (empty($email_id))
			{
				$_SESSION['errors']['email_id'] = "Please enter your email address";
			}
			else
			{
				if ( ! filter_var($email_id, FILTER_VALIDATE_EMAIL)) 
				{ 
	    			$_SESSION['errors']['email_id'] = "Invalid email_id"; 
				}
			}
		
			if (empty($user_name))
			{
				$_SESSION['errors']['user_name'] = "Please enter your user name";
			}
		}
		if (!empty ($password))
		{
			if (empty($confirm_password))
			{
				$_SESSION['errors']['confirm_password'] = "Please confirm your password";
			}
			else if($confirm_password != $password)
			{
				$_SESSION['errors']['confirm_password'] = "Password not match.";
			}
		}
		if (empty($address_line1))
		{
			$_SESSION['errors']['address_line1'] = "Please enter your address";
		}
		if (empty($address_line2))
		{
			$_SESSION['errors']['address_line2'] = "Please enter your address";
		}
		if (empty($city))
		{
			$_SESSION['errors']['city'] = "Please enter your city";
		}
		if (empty($zip_code))
		{
			$_SESSION['errors']['zip_code'] = "Please enter your zip code";
		}
		else
		{
			if (!preg_match("/^\d{6}$/", $zip_code))
			{
				$_SESSION['errors']['zip_code'] = "invalid zip code";
			}
		}
		if (empty($state))
		{
			$_SESSION['errors']['state'] = "Please enter your city";
		}
		if (empty($country))
		{
			$_SESSION['errors']['country'] = "Please enter your country";
		}
		if (count($_SESSION['errors']) == 0)
		{
			if($_SESSION['privilege'] == 1)
			{
				if(empty($password))
				{
		   			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $address_line1, $address_line2, $city, $zip_code, $state, $country, $edit_user_id));
					$_SESSION['edit_user'] = $edit_user_id;
					header('location: ../user_profile.php');
				}
				else
				{
					$salt = "#asd!&%lkjhgd@@@";
					$hash_password = md5(md5($salt) + md5($password));
	    			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, password = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $hash_password, $address_line1, $address_line2, $city, $zip_code, $state, $country, $edit_user_id));
					$_SESSION['edit_user'] = $edit_user_id;
					header('location: ../user_profile.php');
				}
			}
			else if($_SESSION['privilege'] == 2)
			{
				if(empty($password))
				{
		   			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, user_name = ?, email_id = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $user_name, $email_id, $address_line1, $address_line2, $city, $zip_code, $state, $country, $edit_user_id));
					$_SESSION['edit_user'] = $edit_user_id;
					header('location: ../user_profile.php');
				}
				else
				{
					$salt = "#asd!&%lkjhgd@@@";
					$hash_password = md5(md5($salt) + md5($password));
	    			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, user_name = ?, email_id = ?, password = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $user_name, $email_id, $hash_password, $address_line1, $address_line2, $city, $zip_code, $state, $country, $edit_user_id));
					$_SESSION['edit_user'] = $edit_user_id;
					header('location: ../user_profile.php');
				}	
			}
		}
		else
		{
			$_SESSION['edit_user'] = $edit_user_id;
			header('location: ../user_profile.php');	
		}
}
		
?>