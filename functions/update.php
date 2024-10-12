<?php
include '../sqlcon.php';

// Check if product ID is provided in the URL parameters
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve product details from the database
    $sql = "SELECT * FROM products1 WHERE pid = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $brand = $row['brand'];
        $price = $row['price'];
        $current_image_url = $row['image'];
    } else {
        echo "Product not found.";
        exit(); // Stop further execution
    }
} else {
    echo "
    <div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Product ID not provided.</div>
    <!-- Redirect back to the same page after displaying the message -->
 <script>
    setTimeout(function() {
        window.location.href = '../forms/products.php';
    }, 3000); // Redirect after 3 seconds
</script> 
    ";

    exit(); // Stop further execution
}

// Check if form is submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $bno = trim($_POST["bno"]);
    $name = trim($_POST["name"]);
    $brand = trim($_POST["brand"]);
    $qty = trim($_POST["qty"]);
    $minqty = trim($_POST["minqty"]);
    $price = trim($_POST["price"]);

    // Check if all fields are non-empty
    if (!empty($name) && !empty($price)) {
        // Check if a new image file is uploaded
        if (isset($_FILES["new_image"]) && $_FILES["new_image"]["error"] == 0) {
            // File information
            $fileName = $_FILES["new_image"]["name"];
            $fileTmpName = $_FILES["new_image"]["tmp_name"];
            $fileSize = $_FILES["new_image"]["size"];
            $fileType = $_FILES["new_image"]["type"];
            
            // Allow certain file formats
            $allowedExtensions = array("jpg", "jpeg", "png");
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            if (in_array($fileExtension, $allowedExtensions)) {
                // Generate unique file name
                $newFileName = uniqid() . '.' . $fileExtension;
                
                // File upload destination
                $uploadDir = "../uploads/";
                $uploadPath = $uploadDir . $newFileName;
                
                // Move uploaded file to destination
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    // Update product in database with new image path
                    $sql = "UPDATE products1 SET batchNo='$bno', name='$name', brand='$brand', price='$price',available_qty='$qty', minimum_qty='$minqty', image='$uploadPath' WHERE pid = $id";
                    
                    // Execute SQL query
                    if (mysqli_query($con, $sql)) {
                        echo "<div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Product updated successfully!</div>";
                    } else {
                        echo "Error updating record: " . mysqli_error($con);
                    }
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                echo "Only JPG, JPEG, and PNG files are allowed.";
            }
        } else {
            // If no new image file is uploaded, update product details without modifying the image
            $sql = "UPDATE products1 SET batchNo='$bno', name='$name', brand='$brand', price='$price',available_qty='$qty', minimum_qty='$minqty', image='$current_image_url' WHERE pid = $id";                    
            // Execute SQL query
            if (mysqli_query($con, $sql)) {
                echo "<div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Product updated successfully!</div>";
            } else {
                echo "Error updating record: " . mysqli_error($con);
            }
        }
    } else {
        echo "Name and Price are required fields.";
    }
}
?>

<!-- Redirect back to the same page after displaying the message -->
<script>
setTimeout(function() {
    window.location.href = '../forms/Admin_head/index.php?page=products';
}, 1000); // Redirect after 1 seconds
</script>