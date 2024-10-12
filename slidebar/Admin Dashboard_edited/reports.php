<?php

include 'header.php';

require_once '../sqlcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports</title>
  <link rel="stylesheet" href="../header.css">
  <link rel="stylesheet" href="../dropdown.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="header">
    <button class="menu-toggle" onclick="toggleMenu()">&#9776;</button>
    <div class="company-name">MRF Universe</div>
    <div class="admin">
      <img src="../image/adminpng.png" alt="Admin Logo">
      <div class="admin-options">
        <a href="admin_settings.php">Admin Settings</a>
        <a href="../loginORregister/logout.php">Logout</a>
      </div>
    </div>
  </div>
  <div class="sidebar" id="sidebar">
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="stockalert.php">Stock Alert</a></li>
      <li><a href="#">Reports</a></li>
      <li><a href="#">Billing</a></li>
    </ul>
  </div>
  <div class="content">
    <h1>Reports</h1>
    <?php
require_once '../sqlcon.php';

// Example query to fetch reports data
$sql = "SELECT * FROM reports";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h2>" . $row["report_title"] . "</h2>";
        echo "<p>" . $row["report_content"] . "</p>";
        echo "</div>";
    }
} else {
    echo "No reports available.";
}

// Close database connection
mysqli_close($con);
?>

  </div>
  <script src="../script.js"></script>
</body>
</html>
