<?php include 'header.php'; ?>


    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="position: relative;">
                        <h1 style="text-align: center;">Add Product</h1>
                        <div style="position: absolute; top: 10px; right: 10px;">
                            <a href="products.php" style="text-decoration: none;">
                                <button style="height: 30px; width: 30px; background-color: red; border-radius: 50%; font-size: 14px; color: white; border: none;">X</button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../functions/imageupload.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product Name" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter Brand">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter Price" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label><br>
                                <input type="file" name="image" id="image" accept=".png, .jpeg" class="form-control-file">
                            </div>

                            <br>

                            <input type="submit" name="submit" class="btn btn-primary" value="Add Product">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
