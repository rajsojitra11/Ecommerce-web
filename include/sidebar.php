<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Welcome Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="../admin/index.php" class="nav-link active">
                        <i class="fa-solid fa-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                </li>
                <li class="nav-item">
                    <a href="../admin/update.php" class="nav-link">
                        <i class="fa-solid fa-address-card"></i>
                        <p>Update Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-truck"></i>
                        <p>See Orders <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../admin/pendingorder.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Total Pendings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="completorder.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Completed Orders</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Product <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./addproduct.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../admin/manageproduct.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="./seeuser.php" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>See Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./message.php" class="nav-link">
                        <i class="fa-solid fa-envelope"></i>
                        <p>See Message</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>