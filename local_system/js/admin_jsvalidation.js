
$(document).ready(function() 
{
    $("#submit").click(function() 
        {
            var name = $("#admin_id").val();
            var password = $("#password").val();
            if (name == '' || password == '') 
            {
                alert("Please fill all fields...!!!!!!");
            }
        });
});