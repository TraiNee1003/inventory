<?php include 'header.php'; ?>
<?php require_once '../sqlcon.php'; ?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        a{
            text-decoration: none;
        }
        div{
           
        }
    </style>
</head>
<body>
 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1><center>Products Dashboard</center></h1>
                    </div>
                    <div class="card-body">
                        <a href="addproduct.php" class="text-light"><button class="btn btn-success">Add New Product</button></a>

                        <form action="searchproduct.php" method="get">
                            <div style="float:right; margin-right:10px;">
                                <input type="text" name="search" class="" placeholder="Search">

                                <a href='searchproduct.php'><button class="btn btn-success" >Search</button></a>
                            </div>

                        </form>
                        
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                 <?php
                                $sql = "SELECT * FROM `products`";
                                $result = mysqli_query($con, $sql);
                                $sn = 1;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) { // Move mysqli_fetch_array() inside the loop
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $brand = $row['brand'];
                                        $price = $row['price'];
                                        $image = $row['image'];

                                        echo "<tr>
                                            <td>$sn</td>
                                            <td><img src='$image' style='max-width: 100px; max-height: 100px;' alt='Product Image'></td>
                                            <td>$name</td>
                                            <td>$brand</td>
                                            <td>$price</td>
                                            <td>
                                                <a href='../forms/updateproduct.php?updateid=$id' class='text-light'><button class='btn btn-primary'>Update</button></a>
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
                window.location.href = "../functions/delete.php?deleteid=" + id;
                alert("Item deleted!"); // Replace this with your actual deletion code
            } else {
                // If the user clicks "Cancel," do nothing or provide feedback
                alert("Deletion canceled!");
            }
        }
    </script>

</body>
</html>
