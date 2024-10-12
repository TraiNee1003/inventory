<?php
if(isset($_POST['update'])){
    include '../sqlcon.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if passwords match
    if($password != $confirm_password) {
        echo "<script>alert('Passwords do not match')
        
            setTimeout(function() {
                window.location.href = '../forms/Admin_head/index.php?page=admin_settings';
            }, 1000); // Redirect after 1 seconds
            </script>";
        exit(); // Stop further execution
    }
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Update admin details in the database
    $sqlupdate = "UPDATE `user` SET `password`='$hashedPassword' WHERE `username`='$username'";
    $update = mysqli_query($con, $sqlupdate);

    if(!$update){
        echo "<script>alert('Error updating record');</script>";
    }
    else{
        echo "
        <div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Successfully updated record</div>
        <script>
            setTimeout(function() {
                window.location.href = '../forms/Admin_head/index.php?page=admin_settings';
            }, 1000); // Redirect after 1 seconds
        </script>
        ";
        
        exit(); // Stop further execution
    }
} else {
    // If the form is not submitted properly, redirect to admin settings page
    header('location: ../forms/Admin_head/index.php?page=admin_settings');
    exit(); // Stop further execution
}
?>
