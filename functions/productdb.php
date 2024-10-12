<?php

// Database connection
$conn = mysqli_connect("localhost", "root", "", "mrf");

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute SQL query to insert product details
if (mysqli_query($conn, $sql)) {
    // If the query is successful, you may optionally display a success message here
    echo "<div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Product added successfully!</div>";
} else {
    // If the query fails, you may display an error message or handle the error in another way
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>