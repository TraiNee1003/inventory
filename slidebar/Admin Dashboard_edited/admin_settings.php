<?php include 'header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h1 style="text-align: center;">Admin Settings</h1>
                    <div style="position: absolute; top: 10px; right: 10px;">
                        <a href="products.php" style="text-decoration: none;">
                            <button style="height: 30px; width: 30px; background-color: red; border-radius: 50%; font-size: 14px; color: white; border: none;">X</button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="../functions/update_admin.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                        </div>
                        <input type="submit" name="update" class="btn btn-primary" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
