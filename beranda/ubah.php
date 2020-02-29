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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $sk_jabatan = $_POST['sk_jabatan'];
    $tanggal_sk = $_POST['tanggal_sk'];
    $unit_kerja = $_POST['unit_kerja'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];


    if ((isset($_POST['catatan']))) {
        $catatan = $_POST['catatan'];
        $sql = $pdo->prepare(
            "UPDATE data_kerja SET nama=:nama, nip=:nip, sk_jabatan=:sk_jabatan, tanggal_sk=:tanggal_sk, unit_kerja=:unit_kerja, jabatan=:jabatan, keterangan=:keterangan, catatan=:catatan WHERE id=:id"
        );
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':sk_jabatan', $sk_jabatan);
        $sql->bindParam(':tanggal_sk', $tanggal_sk);
        $sql->bindParam(':unit_kerja', $unit_kerja);
        $sql->bindParam(':jabatan', $jabatan);
        $sql->bindParam(':keterangan', $keterangan);
        $sql->bindParam(':catatan', $catatan);
        $sql->bindParam(':id', $id);
        if ($sql->execute()) {
            echo "<script>
                alert('Data berhasil diubah');
                window.location.href='index';
                </script>";
        } else {
            echo "<script>
                alert('Error');
                window.location.href='index';
                </script>";
        }
    } else {
        $sql = $pdo->prepare(
            "UPDATE data_kerja SET nama=:nama, nip=:nip, sk_jabatan=:sk_jabatan, tanggal_sk=:tanggal_sk, unit_kerja=:unit_kerja, jabatan=:jabatan, keterangan=:keterangan WHERE id=:id"
        );
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':sk_jabatan', $sk_jabatan);
        $sql->bindParam(':tanggal_sk', $tanggal_sk);
        $sql->bindParam(':unit_kerja', $unit_kerja);
        $sql->bindParam(':jabatan', $jabatan);
        $sql->bindParam(':keterangan', $keterangan);
        $sql->bindParam(':id', $id);
        if ($sql->execute()) {
            echo "<script>
                alert('Data berhasil diubah');
                window.location.href='index';
                </script>";
        } else {
            echo "<script>
                alert('Error');
                window.location.href='index';
                </script>";
        }
    }
}

$query = "SELECT * FROM data_kerja WHERE id = '$idUser'";
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
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- general form elements -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Detail Data</h3>
                                        <?php
                                        if (isset($warning)) {
                                            echo "<br><span class='btn btn-warning btn-sm' style=''>" . $warning . "</span>";
                                        } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $row['nama']; ?>" name="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input type="text" class="form-control" placeholder="" name="nip" value="<?= $row['nip']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>SK Jabatan</label>
                                                    <input type="text" class="form-control" placeholder="" name="sk_jabatan" value="<?= $row['sk_jabatan']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- general form elements -->
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Tanggal SK</label>
                                                    <input type="hidden" name="id" value="<?= $idUser ?>">
                                                    <input type="date" class="form-control" placeholder="" name="tanggal_sk" value="<?= $row['tanggal_sk']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit Kerja</label>
                                                    <textarea class="form-control" rows="3" placeholder="" name="unit_kerja"><?= $row['unit_kerja']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" class="form-control" placeholder="" name="jabatan" value="<?= $row['jabatan']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- general form elements -->
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <?php
                                                $tanggal1 = new DateTime($row['tanggal_sk']);
                                                $tanggal2 = new DateTime();
                                                $masa_kerja = ($tanggal2->diff($tanggal1)->format("%a")) / 365;
                                                ?>
                                                <div class="form-group">
                                                    <label>Masa Kerja</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $masa_kerja; ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea class="form-control" rows="3" placeholder="" name="keterangan"><?= $row['keterangan']; ?></textarea>
                                                </div>
                                                <?php
                                                if ($role == 1) {
                                                    echo "<div class='form-group'>
                                                            <label>Catatan</label>
                                                            <textarea class='form-control' rows='3' name='catatan'>" . $row['catatan'] . "</textarea>
                                                        </div>";
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </di>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-info btn-block" name="ubah">Ubah Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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