<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "mrf");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch low stock items
$sql = "SELECT * FROM `products1` WHERE `available_qty` <= `minimum_qty`";
$result = mysqli_query($con, $sql);
$sn = 1;

$body = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Stock Alerts</title>
    <style>
        table {width: 100%; border-collapse: collapse;}
        th, td {border: 1px solid #ddd; padding: 8px;}
        th {background-color: #f2f2f2;}
        .low-stock {background-color: #f8d7da; color: #721c24;}
    </style>
</head>
<body>
    <h1>Stock Alerts</h1>
    <table>
        <thead>
            <tr>
                <th>SN</th>
                <th>Image</th>
                <th>Batch No</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['pid'];
        $bno = $row['batchNo'];
        $name = $row['name'];
        $brand = $row['brand'];
        $qty = $row['available_qty'];
        $price = $row['price'];
        $image = '../' . $row['image'];

        $body .= "
        <tr>
            <td>{$sn}</td>
            <td><img src='{$image}' style='max-width: 80px; max-height: 80px;' alt='Product Image'></td>
            <td>{$bno}</td>
            <td>{$name}</td>
            <td>{$brand}</td>
            <td class='low-stock'>{$qty}</td>
            <td>{$price}</td>
        </tr>";
        $sn++;
    }
} else {
    $body .= "<tr><td colspan='7'>No stock alerts found.</td></tr>";
}

$body .= "
        </tbody>
    </table>
</body>
</html>";

// Email configuration
$to = "mohammedjesa144@gmail.com";
$subject = "Stock Alerts Notification";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: mohammedjesa144@gmail.com" . "\r\n";

// Send email
if (mail($to, $subject, $body, $headers)) {
    echo "Email successfully sent to $to...";
} else {
    echo "Email sending failed...";
}

// Close the database connection
mysqli_close($con);
?>