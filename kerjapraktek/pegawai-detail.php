<?php
include '../../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:login");
}

// Cek apakah yang login adalah pegawai
if ($_SESSION['role'] != "pegawai") {
    header("location:../login");
}

$nama = $_SESSION['nama'];
// username pengguna dan id nya
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$userID = $row['id'];

$role = $_SESSION['role'];

$idKP = base64_decode(urldecode($_GET['id']));
// echo $idKP;

$query = "SELECT A.id, A.nama, A.nim, A.telepon, A.alamat, A.prodi, A.khs, A.transkrip, B.kode_unik, B.id AS status_id FROM data_kerjapraktek A, data_kerjapraktek_status B WHERE A.id = B.data_kerjapraktek_id AND A.id = '$idKP'";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$data_kerjapraktek_id = $row['id'];
$kodeUnik = $row['kode_unik'];
$statusID = $row['status_id'];
// echo $statusID;

if (isset($_POST['diterima'])) {
    updateJejakKP($pdo, "Pegawai", $statusID, $userID);
    updateStatusKP($pdo, "Pegawai", "Accept", $_POST['keterangan'], $_POST['id'], "");
}
if (isset($_POST['direvisi'])) {
    updateJejakKP($pdo, "Pegawai", $statusID, $userID);
    updateStatusKP($pdo, "Pegawai", "Revisi", $_POST['keterangan'], $_POST['id'], "");
}
if (isset($_POST['ditolak'])) {
    updateJejakKP($pdo, "Pegawai", $statusID, $userID);
    updateStatusKP($pdo, "Pegawai", "Reject", $_POST['keterangan'], $_POST['id'], "");
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
                                <div class="card-header">
                                    <h3 class="card-title">Dosen Pembimbing</h3>
                                </div>
                                <?php
                                $query = "SELECT * FROM data_kerjapraktek_doping WHERE data_kerjapraktek_id = '$idKP'";
                                $result = $pdo->query($query);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Dosen Pembimbing</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['doping_1']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Dosen Pembimbing (Referensi 1)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['doping_2']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Dosen Pembimbing (Referensi 2)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['doping_3']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Perusahaan</h3>
                                </div>
                                <?php
                                $query = "SELECT * FROM data_kerjapraktek_kelompok_detail_perusahaan WHERE kode_unik = '$kodeUnik'";
                                $result = $pdo->query($query);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Perusahaan</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['nama_perusahaan_1']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Alamat Perusahaan</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['alamat_perusahaan_1']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Provinsi Perusahaan</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['provinsi_1']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Surat Ditujukan Kepada</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['tertuju_1']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama Perusahaan (Referensi 1)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['nama_perusahaan_2']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat Perusahaan (Referensi 1)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['alamat_perusahaan_2']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Provinsi Perusahaan (Referensi 1)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['provinsi_2']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Surat Ditujukan Kepada (Referensi 1)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['tertuju_2']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Nama Perusahaan (Referensi 2)</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['nama_perusahaan_3']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat Perusahaan (Referensi 2</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['alamat_perusahaan_3']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Provinsi Perusahaan (Referensi 2</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['provinsi_3']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Surat Ditujukan Kepada (Referensi 2</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['tertuju_3']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Mulai Kerja Praktek</label>
                                                <input type="text" class="form-control" placeholder="" value="<?= $row['mulai']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lampiran</h3>
                                </div>
                                <?php
                                $query = "SELECT * FROM data_kerjapraktek WHERE id = '$data_kerjapraktek_id'";
                                $result = $pdo->query($query);
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <label for="">Jumlah SKS</label>
                                            <input type="text" class="form-control" placeholder="" value="<?= $row['sks']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <label for="">Indeks Prestasi Komulatif (IPK)</label>
                                            <input type="text" class="form-control" placeholder="" value="<?= $row['ipk']; ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <a href="<?= "../../images/surat_kp/" . $row['nim'] . "-" . $row['tanggal_tampil'] . "/" . $row['khs']; ?>" class="btn btn-info btn-lg btn-block" target="_blank">KRS</a>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <a href="<?= "../../images/surat_kp/" . $row['nim'] . "-" . $row['tanggal_tampil'] . "/" . $row['transkrip']; ?>" class="btn btn-info btn-lg btn-block" target="_blank">KHS</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Validasi Pegawai</h3>
                                </div>
                                <form role="form" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input type="hidden" value="<?= $data_kerjapraktek_id ?>" name="id">
                                                    <textarea class="form-control" rows="4" placeholder="" spellcheck="false" name="keterangan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-info btn-lg" name="diterima">Diterima</button>
                                        <button type="submit" class="btn btn-warning btn-lg" name="direvisi">Direvisi</button>
                                        <button type="submit" class="btn btn-danger btn-lg" name="ditolak">Ditolak</button>
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