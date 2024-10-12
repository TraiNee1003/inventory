<?php
// Database connection
$con = new mysqli('localhost', 'root', '', 'mrf');
if ($con->connect_error) {
    die('Connection failed: ' . $con->connect_error);
}

// Get the search term
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Prepare the SQL query
$sql = "SELECT pid, batchNo, name, price, brand, image, available_qty FROM products1 WHERE name LIKE ? OR batchNo LIKE ?";
$stmt = $con->prepare($sql);
$searchTerm = "%$searchTerm%";
$stmt->bind_param('ss', $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results and return them as JSON
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$stmt->close();
$con->close();

echo json_encode($products);
?>