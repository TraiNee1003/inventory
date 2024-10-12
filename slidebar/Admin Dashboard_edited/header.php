<?php require_once '../coreSes.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <link rel="stylesheet" href="../header.css">
  <link rel="stylesheet" href="../dropdown.css">
  <link rel="stylesheet" href="../sidebar.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-YLXTvgw9JcGHEOXzC6Q8usE/5fjc3FZxYJiVTfMNO8XHrD2A2JfOLzhPwibopAQhzwv7cjb66vms3yFlXyH+5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
      <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="products.php"><i class="fas fa-box"></i> Products</a></li>
      <li><a href="stockalert.php"><i class="fas fa-exclamation-triangle"></i> Stock Alert</a></li>
      <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
      <li><a href="#"><i class="fas fa-money-bill-wave"></i> Billing</a></li>
    </ul>
  </div>
  <script src="../script.js"></script>
</body>
</html>
