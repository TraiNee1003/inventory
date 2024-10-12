<?php



// SQL query to select products with available quantity less than minimum quantity
$sql = "SELECT * FROM products WHERE available_quantity < minimum_quantity";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Insert alert details into the alerts table
        $insert_sql = "INSERT INTO alerts (product_id, product_name, available_quantity, minimum_quantity) VALUES ('" . $row["product_id"]. "', '" . $row["product_name"]. "', '" . $row["available_quantity"]. "', '" . $row["minimum_quantity"]. "')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "Alert added successfully for Product ID: " . $row["product_id"] . "<br>";
        } else {
            echo "Error adding alert: " . $conn->error;
        }
    }
} else {
    echo "No products with available quantity less than minimum quantity.";
}



// Retrieve alerts from the alerts table
$sql = "SELECT * FROM alerts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row in an alerts form
    echo "<div class='alerts-form'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='alert'>Product ID: " . $row["product_id"]. ", Name: " . $row["product_name"]. ", Available Quantity: " . $row["available_quantity"]. ", Minimum Quantity: " . $row["minimum_quantity"]. "</div>";
    }
    echo "</div>";
} else {
    echo "No alerts.";
}

$conn->close();

?>