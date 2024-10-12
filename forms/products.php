<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>
                        <center>Products Dashboard</center>
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <a href="index.php?page=addnew" class="btn btn-success text-light w-100">Add New Product</a>
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="index.php?page=searchproduct" class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Search products">
                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                            </form>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Image</th>
                                <th scope="col">BatchNo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $sql = "SELECT * FROM `products1`";
                                $result = mysqli_query($con, $sql);
                                $sn = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) { // Move mysqli_fetch_array() inside the loop
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
                                            <td>$qty</td>
                                            <td>$price</td>
                                            <td>
                                                <a href='index.php?page=updateproduct&updateid=$id' class='text-light'><button class='btn btn-primary'>Update</button></a>
                                                <a href='javascript:void(0);' class='text-light'><button class='btn btn-danger' onclick='confirmDelete($id)'>Delete</button></a>
                                            </td>
                                        </tr>";
                                        $sn++;
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                                }
                                ?>





                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    // Display a confirmation dialog
    var result = window.confirm("Are you sure you want to delete?");

    // If the user clicks "OK," proceed with the deletion
    if (result) {
        // Add your deletion logic here
        window.location.href = "../../functions/delete.php?deleteid=" + id;
        alert("Item deleted!"); // Replace this with your actual deletion code
    } else {
        // If the user clicks "Cancel," do nothing or provide feedback
        alert("Deletion canceled!");
    }
}
</script>