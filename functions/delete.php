<?php
include '../sqlcon.php';

// Check if product ID is provided in the URL parameters
if (isset($_GET['deleteid'])) {
    // Retrieve the product ID
    $id = $_GET['deleteid'];

    // Construct the SQL query to delete the product
    $sql = "DELETE FROM products1 WHERE pid = $id";

    // Execute the SQL query
    if (mysqli_query($con, $sql)) {
        // If deletion is successful, redirect back to the product products with a success message
        header("Location: ../forms/Admin_head/index.php?page=products&delete_success=true");
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    // If product ID is not provided in the URL parameters, redirect back to the product products
    header("Location: ../forms/Admin_head/index.php?page=products");
    exit();
}
?>