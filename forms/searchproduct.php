<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>
                        <center>Searched Products</center>
                    </h1>
                    <div style="position: absolute; top: 10px; right: 10px;">
                        <a href="index.php?page=products" style="text-decoration: none;">
                            <button
                                style="height: 30px; width: 30px; background-color: red; border-radius: 50%; font-size: 14px; color: white; border: none;">X</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <a href="index.php?page=addnew" class="text-light"><button class="btn btn-success">Add New
                            Product</button></a> -->
                    <form method="post" action="" class="mt-3 mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search products">
                            <div class="input-group-append">
                                <button type="submit" id="search-button" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

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
                            // Check if search query is set
                            if (isset($_POST['search'])) {
                                $search = mysqli_real_escape_string($con, $_POST['search']);
                                $sql = "SELECT * FROM `products1` WHERE `name` LIKE '%$search%'";
                            } else {
                                $sql = "SELECT * FROM `products1`";
                            }

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
                                    $image = '../' . $row['image'];

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
                                echo "<tr><td colspan='8'>No products found.</td></tr>";
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
    var result = window.confirm("Are you sure you want to delete?");

    if (result) {
        window.location.href = "../../functions/delete.php?deleteid=" + id;
        alert("Item deleted!");
    } else {
        alert("Deletion canceled!");
    }
}

document.getElementById('search-button').addEventListener('click', function() {
    let searchTerm = document.getElementById('search-input').value;

    fetch(`searchproduct.php?search=${searchTerm}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('home-content').innerHTML = data;
        });
});
</script>