function login_check()
{
	var user_name = document.registration.user_name.value;  
	var password = document.registration.password.value;
	if(user_name == "" || password == "")
	{
		alert ( "There are some empty fiels. Please fill all required fields." );
		return false;
	}
	else
	{
		if (password.length < 6) 
		{
		  	alert('Please enter at least 6 characters in password');  
			password.focus(); 
		  	return false;
		}
	}
}