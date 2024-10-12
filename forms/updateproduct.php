<?php 

// Check if product ID is provided in the URL parameters
if (isset($_GET['updateid'])) {
    $id = $_GET['updateid'];

    // Retrieve product details from the database
    $sql = "SELECT * FROM products1 WHERE pid = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $bno = $row['batchNo']; 
        $name = $row['name'];
        $brand = $row['brand'];
        $qty = $row['available_qty'];
        $minqty = $row['minimum_qty'];
        $price = $row['price'];
        $image = '../'.$row['image'];
    } else {
        echo "Product not found.";
        exit(); // Stop further execution
    }
} else {
    echo "
    <div style='text-align: center; padding: 20px; background-color: #dff0d8; border: 1px solid #3c763d; color: #3c763d; border-radius: 5px;'>Product ID not provided.</div>
    <!-- Redirect back to the same page after displaying the message -->
 <script>
    setTimeout(function() {
        window.location.href = '../forms/products.php';
    }, 3000); // Redirect after 3 seconds
</script> 
    ";

    exit(); // Stop further execution
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h1 style="text-align: center;">Update Product</h1>
                    <div style="position: absolute; top: 10px; right: 10px;">
                        <a href="index.php?page=products" style="text-decoration: none;">
                            <button
                                style="height: 30px; width: 30px; background-color: red; border-radius: 50%; font-size: 14px; color: white; border: none;">X</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="../../functions/update.php" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="bno">BatchNo</label>
                            <input type="text" name="bno" id="bno" class="form-control" placeholder="Enter Product Name"
                                value="<?php echo $bno; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter Product Name" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter Brand"
                                value="<?php echo $brand; ?>">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Qty</label>
                            <input type="number" name="qty" id="quantity" class="form-control"
                                placeholder="Enter quantity" value="<?php echo $qty; ?>">
                        </div>
                        <div class="form-group">
                            <label for="minquantity">MInimumQty</label>
                            <input type="number" name="minqty" id="minqty" class="form-control"
                                placeholder="Enter Minimum quantity" value="<?php echo $minqty; ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price"
                                step="0.01" value="<?php echo $price; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="current_image">Current Image</label><br>
                            <img src="<?php echo $image ?>" style="max-width: 150px; max-height: 150px;"
                                alt="Current Image"><br>
                            <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="new_image">New Image</label><br>
                            <input type="file" name="new_image" id="new_image" accept=".png, .jpeg, .jpg"
                                class="form-control-file">
                        </div>


                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <!-- Hidden input field to send product ID to the update script -->

                        <br>

                        <input type="submit" name="submit" class="btn btn-primary" value="Update Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>