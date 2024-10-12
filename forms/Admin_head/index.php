<?php
if (isset($_GET['page'])){
  $page = $_GET['page'];
  $pagename = '../' . $page . '.php';
}
else{
  $pagename = '../home.php';
}

require_once '../../functions/coreSes.php';
require_once '../../sqlcon.php';
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>MRF UNIVERSE</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="dropdown.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    body,
    .home-section {
        background-image: url('images/Cover.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    a {
        text-decoration: none;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxl-slack'></i>
            <span class="logo_name" style="">MRF UNIVERSE</span>
        </div>
        <ul class="nav-links ps-0">
            <li>
                <a href="../Admin_head/index.php?page=home">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../Admin_head/index.php?page=products">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Product</span>
                </a>
            </li>
            <li>
                <a href="../Admin_head/index.php?page=stockalert">
                    <i class="bx bx-message"></i>
                    <span class="links_name">Stock Alert</span>
                </a>
            </li>
            <li>
                <a href="../sales.php">
                    <i class='bx bx-cart-add'></i>
                    <span class="links_name">Sales</span>
                </a>
            </li>
            <li>
                <a href="../Admin_head/index.php?page=reports">
                    <i class='bx bx-file'></i>
                    <span class="links_name">Report</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard" style="color:gray;"><?php echo date('d/M/Y'); ?></span>
            </div>


            <!-- <div class="search-box">
                <form method="post" action="../searchproduct.php">
                    <input type="text" name="search" placeholder="Search..." />

                    <a href="../Admin_head/index.php?page=searchproduct"><i class="bx bx-search"></i></a>
                </form>
            </div> -->


            <div class="profile-details">
                <img src="images/favicon.ico" alt="admin" />
                <span class="admin_name">Admin</span>
                <span class="ps-5"><i class="bx bx-chevron-down"></i></span>
                <div class="admin-options">
                    <a href="../Admin_head/index.php?page=admin_settings">Admin Settings</a>
                    <a href="../../loginORregister/logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="home-content">

            <?php include $pagename;?>

        </div>

    </section>

    <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };
    </script>
</body>

</html>