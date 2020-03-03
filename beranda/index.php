<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(0);
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login");
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>

<?php include '../template/head.php'; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include '../template/navbar.php'; ?>
        <!-- /.navbar -->

        <?php include '../template/menu.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="row">
                        <div class="col-md-3 mr-5 ml-5">
                            <img src="Bravo-Bea-Cukai-Fix-Lengkap.png" alt="" width="120%">
                        </div>
                        <div class="col-md-8 mt-3">
                            <h1><b>MONITORING MASA KERJA</b></h1>
                            <h2>DIREKTORAT JENDERAL BEA DAN CUKAI</h2>
                            <h3>Kantor Wilayah DJBC Sumatera Utara</h3>
                            <h4>Bagian Umum</h4>
                        </div>
                    </div>
                </div>

                <img src="bangunan.png" class="card" style="width: 100%; z-index: 0;">
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include '../template/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php include '../template/script.php'; ?>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>