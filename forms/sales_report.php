<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "mrf");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare and bind
    $stmt = $con->prepare("SELECT sales.sale_id, sales.pid, products1.name, products1.batchNo, sales.quantity_sold, sales.sale_price, sales.sale_date, sales.customer_id 
                           FROM sales 
                           JOIN products1 ON sales.pid = products1.pid
                           WHERE sales.sale_date BETWEEN ? AND ?");
    $stmt->bind_param("ss", $start_date, $end_date);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h1 class="text-center">Sales Report <span class="text-primary">from
                            </span><?php echo $start_date; ?> <span class="text-primary">to</span>
                            <?php echo $end_date; ?>
                        </h1>
                    </div>
                    <div class="card-body">
                        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Sale SN</th>
                            <th>Batch No</th>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Sale Price</th>
                            <th>Sale Date</th>
                            <!--<th>Customer ID</th>-->
                        </tr>
                    </thead>
                    <tbody>';
                    $sn = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $sn . '</td>
                        <td>' . $row['batchNo'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['quantity_sold'] . '</td>
                        <td>' . $row['sale_price'] . '</td>
                        <td>' . $row['sale_date'] . '</td>
                        <!--<td>' . $row['customer_id'] . '</td>-->
                      </tr>';
                      $sn++;
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-info">No sales found for the selected period.</div>';
        }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
    // Close the statement and connection
    $stmt->close();
    mysqli_close($con);
}
?>