<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align:center;font-weight:200">
        <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"> SIMASKER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="text-align: center">
            <!-- <div class="image">
                <img src="http://s3.amazonaws.com/37assets/svn/765-default-avatar.png" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info" style="text-align:center">
                <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="../beranda" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../monitoring" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>
                            Monitoring
                        </p>
                    </a>
                </li>

                <?php
                if ($_SESSION['role'] == 1) {
                    echo "
                    <li class='nav-item'>
                        <a href='../pengguna' class='nav-link'>
                            <i class='nav-icon fas fa-user'></i>
                            <p>
                                Pengguna
                            </p>
                        </a>
                    </li>";
                }


                ?>

                <li class="nav-item">
                    <a href="../logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

</aside>