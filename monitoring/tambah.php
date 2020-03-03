<?php
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:login");
}
$username = $_SESSION['username'];
$role = $_SESSION['role'];

if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $uraian_pangkat = $_POST['uraian_pangkat'];
    $sk_jabatan = $_POST['sk_jabatan'];
    $tanggal_sk = $_POST['tanggal_sk'];
    $unit_kerja = $_POST['unit_kerja'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];

    if ((isset($_POST['catatan']))) {
        $catatan = $_POST['catatan'];
        $sql = $pdo->prepare(
            "INSERT INTO data_kerja (nama, nip, uraian_pangkat, sk_jabatan, tanggal_sk, unit_kerja, jabatan, keterangan, catatan) VALUES (:nama, :nip, :uraian_pangkat, :sk_jabatan, :tanggal_sk, :unit_kerja, :jabatan, :keterangan, :catatan)"
        );
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':uraian_pangkat', $uraian_pangkat);
        $sql->bindParam(':sk_jabatan', $sk_jabatan);
        $sql->bindParam(':tanggal_sk', $tanggal_sk);
        $sql->bindParam(':unit_kerja', $unit_kerja);
        $sql->bindParam(':jabatan', $jabatan);
        $sql->bindParam(':keterangan', $keterangan);
        $sql->bindParam(':catatan', $catatan);
        if ($sql->execute()) {
            echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href='index';
                </script>";
        } else {
            echo "<script>
                alert('Error');
                window.location.href='index';
                </script>";
        }
    } else {
        // $query = "INSERT INTO data_kerja (nama, nip, sk_jabatan, tanggal_sk, unit_kerja, jabatan, keterangan) VALUES ('$nama', '$nip', '$sk_jabatan',  '$tanggal_sk',  '$unit_kerja',  '$jabatan', '$keterangan')";
        // echo $query;
        $sql = $pdo->prepare(
            "INSERT INTO data_kerja (nama, nip, uraian_pangkat, sk_jabatan, tanggal_sk, unit_kerja, jabatan, keterangan) 
            VALUES (:nama, :nip, :uraian_pangkat, :sk_jabatan, :tanggal_sk, :unit_kerja, :jabatan, :keterangan)"
        );
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':uraian_pangkat', $uraian_pangkat);
        $sql->bindParam(':sk_jabatan', $sk_jabatan);
        $sql->bindParam(':tanggal_sk', $tanggal_sk);
        $sql->bindParam(':unit_kerja', $unit_kerja);
        $sql->bindParam(':jabatan', $jabatan);
        $sql->bindParam(':keterangan', $keterangan);
        if ($sql->execute()) {
            echo "<script>
                alert('Data berhasil ditambahkan');
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
                                                    <input type="text" class="form-control" placeholder="" name="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label>NIP</label>
                                                    <input type="text" class="form-control" placeholder="" name="nip">
                                                </div>
                                                <div class="form-group">
                                                    <label>Uraian Pangkat</label>
                                                    <input type="text" class="form-control" placeholder="" name="uraian_pangkat">
                                                </div>
                                                <div class="form-group">
                                                    <label>SK Jabatan</label>
                                                    <input type="text" class="form-control" placeholder="" name="sk_jabatan">
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
                                                    <input type="date" class="form-control" placeholder="" name="tanggal_sk">
                                                </div>
                                                <div class="form-group">
                                                    <label>Unit Kerja</label>
                                                    <textarea class="form-control" rows="3" placeholder="" name="unit_kerja"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" class="form-control" placeholder="" name="jabatan">
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
                                                    <label>Keterangan</label>
                                                    <textarea class="form-control" rows="3" placeholder="" name="keterangan"></textarea>
                                                </div>
                                                <?php
                                                if ($role == 1) {
                                                    echo "<div class='form-group'>
                                                            <label>Catatan</label>
                                                            <textarea class='form-control' rows='3' name='catatan'></textarea>
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
                                        <button type="submit" class="btn btn-info btn-block" name="tambah">Tambah Data</button>
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