<?php
	include('../includes/session.php');
	include('../config/database.php');
	
	foreach ($_POST as $key => $value)
	{
		echo $key;
		$$key = trim($value);	
	}
	if(img_submit)
	{
	$target_dir = "/var/www/local_system/user_profiles/";
	$target_file = $target_dir . $_SESSION['user'] . ".jpg" ;
	$_SESSION['upload_error'] = array();
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["img_submit"])) 
	{
	    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    	if($check === false) 
    	{
        	$_SESSION['upload_error'][] = "File is not an image.";
    	}
	}
	// Check if file already exists
	if (file_exists($target_file)) 
	{
	    unlink($target_file);
	}
	// Check file size
	if ($_FILES["profile_pic"]["size"] > 500000) 
	{
	    $_SESSION['upload_error'][] = "Sorry, your file is too large.";
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
	{
	    $_SESSION['upload_error'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	}
	// Check if $uploadOk is set to 0 if there is any error
	if (count($_SESSION['upload_error']) != 0) 
	{
	    $_SESSION['upload_error'][] = "Sorry, your file was not uploaded.";
		header('location: ../user_profile.php');
	} 
	else 
	{
	    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) 
	    {
	    	$result = execute_query("UPDATE user_data SET  profile_pic = '".$_SESSION['user'].".jpg' WHERE user_name = '".$_SESSION['user']."'");
	    	header('location: ../user_profile.php');	
	    } 
	    else 
	    {
	        echo "Sorry, there was an error uploading your file." . '<br/>';
	    }
	}
	}
	if(submit)
	{
		foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
		$_SESSION['errors'] = array();
		if (!preg_match("/^[a-zA-Z'-]+$/", $first_name))
		{
			$_SESSION['errors']['first_name'] = "invalid first name";
		}
	
		if (!preg_match("/^[a-zA-Z'-]+$/", $first_name))
		{
			$_SESSION['errors']['last_name'] = "invalid last name";
		}
	
		if ( ! filter_var($email_id, FILTER_VALIDATE_EMAIL)) 
		{ 
    		$_SESSION['errors']['email_id'] = "Invalid email_id"; 
		}
	
		$_SESSION['errors']['user_name'] = "Please enter your user id";
	}
	if (empty($password))
	{
		$_SESSION['errors']['password'] = "Please enter your password";
	}
	if (empty($confirm_password))
	{
		$_SESSION['errors']['confirm_password'] = "Please confirm your password";
	}
	else
	{
		if($confirm_password != $password)
		{
			$_SESSION['errors']['confirm_password'] = "Password not match.";
		}
	}
	
	
		if (!preg_match("/^\d{6}$/", $zip_code))
		{
			$_SESSION['errors']['zip_code'] = "invalid zip code";
		}
	
	if (count($_SESSION['errors']) == 0)
	{
		$check_duplicate = get_row("SELECT user_name, email_id FROM user_data WHERE user_name= '".$user_name ."' or email_id = '".$email_id."'");
		if($check_duplicate == 0)
		{
			$salt = "#asd!&%lkjhgd@@@";
			$hash_password = md5(md5($salt) + md5($password));
			$result = execute_query("INSERT INTO user_data (first_name, last_name, user_name, email_id, password, address_line1, address_line2, city, zip_code, state, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",array( $first_name, $last_name, $user_name, $email_id, $hash_password, $address_line1, $address_line2, $city, $zip_code, $state, $country));
			$_SESSION['data'] = $_POST;
			$_SESSION['user'] = $_POST['user_name'];
			header('location: ../user_profile.php');	
		}
		else
		{
			$_SESSION['duplicate_user'] = "This email or user name already exist.";
			$_SESSION['data'] = $_POST;
			header('location: ../registration.php');
		}
	}
	else
	{
		$_SESSION['data'] = $_POST;
		header('location: ../registration.php');	
	}

	} 
	//header('location: ../.php');	
?>