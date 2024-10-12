<?php


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $bno = trim($_POST["bno"]);
    $name = trim($_POST["name"]);
    $brand = trim($_POST["brand"]);
    $qty = trim($_POST["quantity"]);
    $minqty = trim($_POST["min_quantity"]);
    $price = trim($_POST["price"]);
    
    // Check if all fields are non-empty
    if (!empty($name) && !empty($price)) {
        // Check if file was uploaded without errors
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            // File information
            $fileName = $_FILES["image"]["name"];
            $fileTmpName = $_FILES["image"]["tmp_name"];
            $fileSize = $_FILES["image"]["size"];
            $fileType = $_FILES["image"]["type"];
            
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
                    // Insert product into database with image path
                    $sql = "INSERT INTO products1 (batchNo, name, brand, available_qty, minimum_qty, price, image) VALUES ('$bno', '$name', '$brand', '$qty','$minqty', '$price', '$uploadPath')";
                    
                    // Execute SQL query
                    include ('productdb.php');
                    
                } else {
                    echo "Failed to upload file.";
                }
            } else {
                echo "Only JPG, JPEG, and PNG files are allowed.";
            }
        } else {
            echo "Please select a file to upload.";
        }
    } else {
        echo "Name and Price are required fields.";
    }
}
?>

<!-- Redirect back to the same page after displaying the message -->
 <script>
   setTimeout(function() {
       window.location.href = '../forms/Admin_head/index.php?page=addnew';
   }, 1000); // Redirect after 1 seconds
</script> 
