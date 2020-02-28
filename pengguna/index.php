<?php
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login");
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = md5($_POST['password']);
    $password_verif = md5($_POST['password_verif']);

    $sql = $pdo->prepare("SELECT username FROM user WHERE username=:username");
    $sql->bindParam(':username', $username);
    $sql->execute();
    $data = $sql->fetch();

    if ($password != $password_verif) {
        $warning = "Periksa kembali inputan anda!";
    } elseif (!empty($data)) {
        $warning = "Username sudah digunakan";
    } else {
        $sql = $pdo->prepare("INSERT INTO user (username,password,role) VALUES (:username, :password, :role)");
        $sql->bindParam(':username', $username);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':role', $role);
        if ($sql->execute()) {
            $success = "Berhasil ditambahkan";
        } else {
            $warning = "Kesalahan proses tambah data";
        }
    }
}

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

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-7">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Data Pengguna
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Hak Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $result = $pdo->query("SELECT * FROM user");
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['role'] == 1) {
                                                        $role = "Master";
                                                    } else {
                                                        $role = "Asisten";
                                                    }
                                                    echo $role;
                                                    ?></td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="ubah?id=<?= urlencode(base64_encode($row['id'])); ?>">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="hapus?id=<?= urlencode(base64_encode($row['id'])); ?>">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-3">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Pengguna</h3>
                            </div>
                            <?php
                            if (isset($warning)) {
                                echo "<span class='btn btn-warning' style='margin:6px;'>" . $warning . "</span>";
                            }
                            if (isset($success)) {
                                echo "<span class='btn btn-primary' style='margin:6px;'>" . $success . "</span>";
                            }

                            ?>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Hak Akses</label>
                                                <select class="form-control" name="role">
                                                    <option value="1">Master</option>
                                                    <option value="2">Asisten</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Validasi Password</label>
                                                <input type="password" class="form-control" placeholder="" name="password_verif" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-info btn-block" name="tambah">Tambah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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