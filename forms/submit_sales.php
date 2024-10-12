<?php
// Connect to the database
$con = new mysqli('localhost', 'root', '', 'mrf');
if ($con->connect_error) {
    die('Connection failed: ' . $con->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve submitted data
    $products = isset($_POST['products']) ? $_POST['products'] : [];
    $total = isset($_POST['total']) ? $_POST['total'] : 0;

    // Begin transaction
    $con->begin_transaction();

    try {
        // Insert each sale and update product quantity
        foreach ($products as $product) {
            $pid = $product['pid'];
            $quantity = $product['quantity'];
            $price = $product['price'];
            $sale_price = $quantity * $price;

            // Update product quantity in products1 table
            $update_sql = "UPDATE products1 SET available_qty = available_qty - ? WHERE pid = ?";
            $update_stmt = $con->prepare($update_sql);
            $update_stmt->bind_param('ii', $quantity, $pid);
            $update_stmt->execute();

            // Insert sale record into sales table
            $insert_sql = "INSERT INTO sales (pid, customer_id, quantity_sold, sale_price) VALUES (?, 1, ?, ?)";
            // Assuming customer_id is 1 for this example, replace with actual customer ID
            $insert_stmt = $con->prepare($insert_sql);
            $insert_stmt->bind_param('iid', $pid, $quantity, $sale_price);
            $insert_stmt->execute();
        }

        // Commit transaction
        $con->commit();

        // Redirect or return success response
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        // Rollback transaction on error
        $con->rollback();

        // Return error response
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

$con->close();
?>