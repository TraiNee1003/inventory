<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <h2>User Registration Form</h2>
  <form action="" method="post">
    <label for="username">User Name:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirmpassword">Confirm Password:</label>
    <input type="password" id="confirmpassword" name="confirmpassword" required>
    
    <input type="submit" name="register" value="Register">
    <div class="extra1">
      <label>Already have an account? <a href="login.php">Login</a></label>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="register.js"></script>
  </form>
</body>
</html>

<?php
if(isset($_POST['register'])){
    include '../sqlcon.php';
    
    $username = $_POST['username'];
    $password = $_POST['confirmpassword'];
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $sqlinsert = "INSERT INTO `user` (`username`,`password`)
                  VALUES ('$username', '$hashedPassword')";

    $insert = mysqli_query($con, $sqlinsert);

    if(!$insert){
        echo "<script>alert('Error inserting record');</script>";
    }
    else{
        echo "<script>alert('Successfully insert record');</script>";
        header('location: login.php?username='.$username);
    }
}
?>
