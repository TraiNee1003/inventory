<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>

    <div class="container">
        <div class="centered-form">
            <h2>Login Form</h2>
            <form method="POST">
                <table>
                    <tr>
                        <td><label for="username">User Name:</label></td>
                        <td><input type="text" name="username"
                                value='<?php if(isset($_GET['username'])){echo ($_GET['username']);} ?>' id="username"
                                required></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password" required></td>
                    </tr>
                </table>
                <input type="submit" name="login" value="Login">
                <!-- <div class="extra1"><label>Don't have an account?<a href="register.php">Register</a></label></div> -->
            </form>
        </div>
    </div>
</body>

</html>


<?php
include '../sqlcon.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    // Prepare and execute the query using a prepared statement
    $query = "SELECT * FROM user WHERE username=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $dbpassword = $row['password'];
        $dbname = $row['username'];
        
        // Verify the entered password with the hashed password
        if (password_verify($password, $dbpassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $dbname;
            header('location: ../forms/Admin_head/index.php');
            exit();
        } else {
            echo '<script>alert("Password is incorrect.");</script>';
            echo '<script>setTimeout(function() { window.location = "login.php"; }, 100);</script>';
            exit();
        }
    } else {
        echo '<script>alert("username does not exist.");</script>';
        echo '<script>setTimeout(function() { window.location = "login.php"; }, 100);</script>';
        exit();
    }
}

// if (isset($_POST['remember'])) {
//     $usernameCookie = "username";
//     $unvalue = $_POST['username'];
//     $expire = (time() + (86400 * 30));

//     setcookie($usernameCookie, $unvalue, $expire);
// }
?>