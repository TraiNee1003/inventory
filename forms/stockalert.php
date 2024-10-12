<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Alerts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1 class="text-center">Stock Alerts</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Batch No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Adjust the SQL query to directly fetch only low stock items
                                $sql = "SELECT * FROM `products1` WHERE `available_qty` <= `minimum_qty`";
                                $result = mysqli_query($con, $sql);
                                $sn = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $id = $row['pid'];
                                        $bno = $row['batchNo'];
                                        $name = $row['name'];
                                        $brand = $row['brand'];
                                        $qty = $row['available_qty'];
                                        $price = $row['price'];
                                        $image = '../'.$row['image'];
                                        echo "<tr>
                                                <td>$sn</td>
                                                <td><img src='$image' style='max-width: 80px; max-height: 80px;' alt='Product Image'></td>
                                                <td>$bno</td>
                                                <td>$name</td>
                                                <td>$brand</td>
                                                <td class='text-light bg-danger'>$qty</td>
                                                <td>$price</td>
                                              </tr>";
                                              // include 'email.php';
                                        $sn++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>No stock alerts found.</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>