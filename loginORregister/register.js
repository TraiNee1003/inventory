
$(document).ready(function(){
    $('#registerBtn').click(function(e){
        e.preventDefault();
        
        var password = $('#password').val();
        var confirmPassword = $('#confirmpassword').val();
        
        // Check if passwords match
        if(password !== confirmPassword) {
            alert("Passwords do not match");
            return false; // Prevent form submission
        }
        
        // If passwords match, proceed with AJAX call or form submission
        $.ajax({
            type: "POST",
            url: "verify_password.php", // This is the PHP file where you handle password verification
            data: {
                password: password,
                confirmPassword: confirmPassword
            },
            success: function(response){
                // Handle response if needed
                // For example, you could show a success message or redirect the user
                alert(response);
            }
        });
    });
});

