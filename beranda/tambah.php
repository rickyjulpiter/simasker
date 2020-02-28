<?php
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:login");
}
// username pengguna dan id nya
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$userID = $row['id'];

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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pengajuan Kerja Praktek</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Kerja Praktek</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Mahasiswa</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['nama']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Telepon</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['telepon']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NIM</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['nim']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Program Studi</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['prodi']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-info btn-block" name="diterima">Tambah Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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

    <!-- jQuery -->
    <?php include '../template/script.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>