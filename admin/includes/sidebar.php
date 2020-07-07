<body>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-none d-lg-block align-items-center">
            <a href="../index.php">
                <img src="img/logo.png" style="height: 80px" alt="">
            </a>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse sidenav-toggler-inner float-right d-lg-none  sidenav-toggler sidenav-toggler-dark m-0" data-action="sidenav-pin" data-target="#sidenav-main" id="sidenav-collapse-main">
            <i class="fas fa-times float-right mb-5" id="close-sidebar"></i>
        </div>
        <div class="navbar-inner">

                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-desktop"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customers.php">
                            <i class="fas fa-user-alt"></i>
                            <span class="nav-link-text">Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            <i class="fas fa-box-open"></i>
                            <span class="nav-link-text">Orders</span>
                        </a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-gift"></i>
                            <span class="nav-link-text">Products</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">All Products</a>
                            <a class="dropdown-item" href="#">Add Product</a>
                            <a class="dropdown-item" href="categories.php">Categories</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="users.php">All Users</a>
                            <a class="dropdown-item" href="add_User.php">Create User</a>
                        </div>
                    </li>




                </ul>
            </div>
        </div>
    </div>
</nav>
