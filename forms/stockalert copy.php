
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
