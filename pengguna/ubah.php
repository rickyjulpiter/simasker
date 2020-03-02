<?php
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:login");
}
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$idUser = urldecode(base64_decode($_GET['id']));

if (isset($_POST['ubah'])) {
    $username = $_POST['username'];
    $oldPassword = md5($_POST['oldPassword']);
    $newPassword = $_POST['newPassword'];
    $newPassword_verif = $_POST['newPassword_verif'];
    $role = $_POST['role'];

    // $sql = $pdo->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
    // $sql->bindParam(':username', $username);
    // $sql->bindParam(':password', $oldPassword);
    // $sql->execute();
    // $data = $sql->fetch();
    if (empty($_POST['newPassword']) && empty($_POST['newPassword_verif'])) {
        $sql = $pdo->prepare("UPDATE user SET role=:role WHERE username=:username");
        $sql->bindParam(':role', $role);
        $sql->bindParam(':username', $username);
        if ($sql->execute()) {
            echo "<script>
                alert('Data pengguna berhasil diubah');
                window.location.href='index';
                </script>";
        }
    } elseif ($newPassword != $newPassword_verif) {
        $warning = "Periksa kembali inputan anda";
    } elseif ($data['password'] != $oldPassword) {
        $warning = "Password yang anda masukkan tidak cocok";
    } else {
        $newPassword = md5($newPassword);
        $sql = $pdo->prepare("UPDATE user SET role=:role, password=:password WHERE username=:username");
        $sql->bindParam(':role', $role);
        $sql->bindParam(':password', $newPassword);
        $sql->bindParam(':username', $username);
        if ($sql->execute()) {
            echo "<script>
                alert('Data pengguna berhasil diubah');
                window.location.href='index';
                </script>";
        }
    }
}

$query = "SELECT * FROM user WHERE id = '$idUser'";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
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
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Detail Pengguna</h3>
                                    <?php
                                    if (isset($warning)) {
                                        echo "<br><span class='btn btn-warning btn-sm' style=''>" . $warning . "</span>";
                                    } ?>
                                </div>
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $row['username']; ?>" name="username" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Hak Akses</label>
                                                    <select class="form-control" name="role">
                                                        <option value="<?= $row['role'] ?>">
                                                            <?php
                                                            if ($row['role'] == 1) {
                                                                $role = "Master";
                                                            } else {
                                                                $role = "Asisten";
                                                            }
                                                            echo $role;
                                                            ?>
                                                        </option>
                                                        <option>---------</option>
                                                        <option value="1">Master</option>
                                                        <option value="2">Asisten</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" placeholder="" name="oldPassword">
                                                </div> -->
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" placeholder="" name="newPassword">
                                                </div>
                                                <div class="form-group">
                                                    <label>Re-Type New Password</label>
                                                    <input type="password" class="form-control" placeholder="" name="newPassword_verif">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-info btn-block" name="ubah">Ubah Data</button>
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