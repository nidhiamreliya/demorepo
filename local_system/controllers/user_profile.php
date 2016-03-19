<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	//check authenticated user or not.
	include('check_authentication.php');
	// Retrive data from post data
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	
	//Update profile picture
	$target_dir = "/var/www/local_system/user_profiles/";
	$imageFileType = pathinfo($_FILES["profile_pic"]["name"],PATHINFO_EXTENSION);
	$target_file = $target_dir . $edit_user_id . "." . $imageFileType ;
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
		// Allow certain file formats only
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
			$_SESSION['upload_error'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}
		// Check if there is any error in uploading files
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

	// Update user information
	if(isset($_POST["submit"])) 
	{
		$_SESSION['errors'] = array();
		// Validate form informations entered by user 
		if (empty($first_name))
		{
			$_SESSION['errors']['first_name'] = "please enter your first name.";
		}
		else
		{
			// Checks if first name contains any numbers or other symbols
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
			// Checks if last name contains any numbers or other symbols
			if (!preg_match("/^[a-zA-Z'-]+$/", $last_name))
			{
				$_SESSION['errors']['last_name'] = "invalid last name";
			}
		}
		// Check if admin loged in and changes email_id or user_name  
		if($_SESSION['privilege'] == 2)
		{
			if (empty($email_id))
			{
				$_SESSION['errors']['email_id'] = "Please enter your email address";
			}
			else
			{
				// Validates entered email id
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
		// Checks if password enterd or not
		if (!empty($password))
		{
			// If password enterd then confirm password
			if (empty($confirm_password))
			{
				$_SESSION['errors']['confirm_password'] = "Please confirm your password";
			}
			else
			{
				// Checks password contains atleast 6 characters 
				if(strlen($password) < 6)
				{
					$_SESSION['errors']['password'] = "Please enter atleast 6 characters .";
				}
				if($confirm_password != $password)
				{
					$_SESSION['errors']['confirm_password'] = "Password not match.";
				}
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
			// Checks if zip code contains 6 digits 
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
			// If there is no errors in form then update data if user is normal user
			if($_SESSION['privilege'] == 1)
			{
				if(empty($password))
				{
		   			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $address_line1, $address_line2, $city, $zip_code, $state, $country, $_SESSION['user_id']));
					header('location: ../user_profile.php');
				}
				else
				{
					$salt = "#asd!&%lkjhgd@@@";
					$hash_password = md5(md5($salt) + md5($password));
	    			$result = execute_query("UPDATE user_data SET first_name = ?, last_name = ?, password = ?, address_line1 = ?, address_line2 = ?, city = ?, zip_code = ?,  state = ?,  country = ? WHERE user_id = ?", array($first_name, $last_name, $hash_password, $address_line1, $address_line2, $city, $zip_code, $state, $country, $_SESSION['user_id']));
					header('location: ../user_profile.php');
				}
			}
			// If there is no errors in form then update data if user is admin user
			else if($_SESSION['privilege'] == 2)
			{
				// Checks if same user name or email id exist in database or not.
				$check_duplicate = get_row("select user_id from user_data where (user_name = ? or email_id = ?) and user_id != ? ", array( $user_name, $email_id, $edit_user_id));
				if($check_duplicate == 0)
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
				else
				{
					$_SESSION['duplicate_user'] = "This email or user name already exist.";
					$_SESSION['edit_user'] = $edit_user_id;
					header('location: ../user_profile.php');
				}		
			}
		}
		else
		{
			// If there is any errors in form then go back to user profile page
			$_SESSION['edit_user'] = $edit_user_id;
			header('location: ../user_profile.php');	
		}
	}
?>