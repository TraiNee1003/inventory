<?php
// Include header file
include 'header.php';
// Include database connection file
require_once '../sqlcon.php';

// Your PHP code for retrieving stock alerts and displaying them goes here

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Alert</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <!-- Add any additional CSS styling if needed -->
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h1><center>Stock Alerts</center></h1>
          </div>
          <div class="card-body">
            
          <div class="card-body">
            <?php
            // Fetch stock alert information from the database
            $sql = "SELECT * FROM `stock_alerts`";
            $result = mysqli_query($con, $sql);

            // Check if there are any stock alerts
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row of the result set
                while ($row = mysqli_fetch_assoc($result)) {
                $product_name = $row['product_name'];
                $current_stock = $row['current_stock'];
                $alert_threshold = $row['alert_threshold'];

                // Display the stock alert information
                echo "<div class='alert alert-warning' role='alert'>";
                echo "<strong>$product_name:</strong> Current stock - $current_stock | Alert Threshold - $alert_threshold";
                echo "</div>";
                }
            } else {
                // If no stock alerts are found
                echo "<div class='alert alert-info' role='alert'>No stock alerts found.</div>";
            }
            ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Add any additional JavaScript if needed -->
</body>
</html>
