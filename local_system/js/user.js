function check_user_form()
{
	
	var validated = true;
	if (document.getElementById("user_id").value == "")
	{
		alert("Please select user");
		document.getElementById("user_id").focus();
		validated = false;		
	}
	validated = validate_date();
	return validated;
}
function validate_date()
		{
			var entry_datetime = document.getElementById("entry_datetime").value;
			var exit_datetime = document.getElementById("exit_datetime").value;
			if (exit_datetime <= entry_datetime)
			{
				alert("you entered wrong entry. please check your dates.");
				ocument.getElementById("exit_datetime").focus();
				return false;
			}
		}
