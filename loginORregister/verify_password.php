<?php

// Function to verify password
function verifyPassword($enteredPassword, $confirmedPassword) {
    // Check if passwords match
    if ($enteredPassword === $confirmedPassword) {
        return "Passwords match!";
    } else {
        return "Passwords do not match!";
    }
}

// Retrieve password and confirm password from POST data
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Verify passwords
$response = verifyPassword($password, $confirmPassword);

// Return response
echo $response;

?>
