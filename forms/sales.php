<?php 
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../loginORregister/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .product-img {
        max-width: 100px;
        max-height: 100px;
    }

    .selected-product {
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <div style="position: absolute; top: 10px; right: 10px;">
        <a href="Admin_head/index.php?page=products" style="text-decoration: none;">
            <button
                style="height: 30px; width: 30px; background-color: red; border-radius: 50%; font-size: 14px; color: white; border: none;">X</button>
        </a>
    </div>
    <div class="container mt-5">
        <h1 class="text-center">Sales Page</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search product..." id="searchInput">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="searchButton">Search</button>
                    </div>
                </div>
                <div id="productDetails">
                    <div class="table-responsive">
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
                            <tbody id="productList">
                                <!-- Product details will be displayed here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Sales</h5>
                    </div>
                    <div class="card-body">
                        <form id="salesForm" action="submit_sales.php" method="post">
                            <ul class="list-group" id="cartList">
                                <!-- Selected products will be listed here -->
                            </ul>
                            <div class="form-group mt-3">
                                <label for="total">Total:</label>
                                <input type="text" class="form-control" id="total" name="total" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchTerm = $('#searchInput').val();
            $.ajax({
                url: 'search_products.php',
                type: 'GET',
                data: {
                    searchTerm: searchTerm
                },
                success: function(data) {
                    var products = JSON.parse(data);
                    $('#productList').empty();
                    if (products.length > 0) {
                        var sn = 1;
                        products.forEach(function(product) {
                            var row = '<tr>' +
                                '<td>' + sn + '</td>' +
                                '<td><img src="' + product.image +
                                '" class="product-img" alt="Product Image"></td>' +
                                '<td>' + product.batchNo + '</td>' +
                                '<td>' + product.name + '</td>' +
                                '<td>' + product.brand + '</td>' +
                                '<td>' + product.available_qty + '</td>' +
                                '<td>Rs.' + product.price + '</td>' +
                                '<td><button class="btn btn-primary" onclick="selectProduct(' +
                                product.pid + ', \'' + product.name + '\', ' +
                                product.price + ')">Add</button></td>' +
                                '</tr>';
                            $('#productList').append(row);
                            sn++;
                        });
                    } else {
                        $('#productList').append(
                            '<tr><td colspan="8">No products found.</td></tr>');
                    }
                }
            });
        });
    });

    function selectProduct(pid, name, price) {
        var selectedProductHtml = '<li class="list-group-item selected-product" id="selected-product-' + pid +
            '">' +
            '<span>' + name + ' - Rs.<span class="product-price">' + price + '</span></span> ' +
            'Qty: <input type="number" value="1" min="1" class="product-quantity" onchange="updateQuantity(' + pid +
            ', ' + price + ')"> ' +
            '<button class="btn btn-danger btn-sm" onclick="removeProduct(' + pid + ')">Remove</button>' +
            '</li>';
        $('#cartList').append(selectedProductHtml);
        updateTotalPrice();
    }

    function updateQuantity(pid, price) {
        var quantity = $('#selected-product-' + pid + ' .product-quantity').val();
        var newPrice = quantity * price;
        $('#selected-product-' + pid + ' .product-price').text(newPrice.toFixed(2));
        updateTotalPrice();
    }

    function removeProduct(pid) {
        $('#selected-product-' + pid).remove();
        updateTotalPrice();
    }

    function updateTotalPrice() {
        var totalPrice = 0;
        $('.selected-product').each(function() {
            var price = parseFloat($(this).find('.product-price').text());
            totalPrice += price;
        });
        $('#total').val(totalPrice.toFixed(2));
    }


    //sales 

    $('#salesForm').submit(function(e) {
        e.preventDefault();

        var products = [];
        $('.selected-product').each(function() {
            var pid = this.id.split('-')[2];
            var quantity = $(this).find('.product-quantity').val();
            var price = $(this).find('.product-price').text() / quantity;
            products.push({
                pid: pid,
                quantity: quantity,
                price: price
            });
        });

        var total = $('#total').val();

        $.ajax({
            url: 'submit_sales.php',
            type: 'POST',
            data: {
                products: products,
                total: total
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    alert('Sales submitted successfully!');
                    // Reset form and cart list
                    $('#salesForm')[0].reset();
                    $('#cartList').empty();
                    updateTotalPrice();
                } else {
                    alert('Error submitting sales: ' + data.message);
                }
            }
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>