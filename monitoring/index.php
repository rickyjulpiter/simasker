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
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="tambah" class="btn btn-info">Tambah Data</a>
                                    <!-- <a target="" href="export_excel.php" class="btn btn-outline-primary"> Export to Excel</a> -->
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="overflow: auto">
                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Uraian Pangkat</th>
                                            <th>SK Jabatan</th>
                                            <th>Tanggal SK</th>
                                            <th>Unit Kerja</th>
                                            <th>Jabatan</th>
                                            <th>Masa Kerja</th>
                                            <th>Keterangan</th>
                                            <?php
                                            if ($role == 1) {
                                                echo "<th>Catatan</th>";
                                            }
                                            ?>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $result = $pdo->query("SELECT * FROM data_kerja");
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            $tanggal1 = new DateTime($row['tanggal_sk']);
                                            $tanggal2 = new DateTime();
                                            $masa_kerja = ($tanggal2->diff($tanggal1)->format("%a")) / 365;
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?php echo $row['nama'] ?></td>
                                                <td><?php echo $row['nip'] ?></td>
                                                <td><?php echo $row['uraian_pangkat'] ?></td>
                                                <td><?php echo $row['sk_jabatan'] ?></td>
                                                <td><?php echo ($row['tanggal_sk']) ?></td>
                                                <td><?php echo $row['unit_kerja'] ?></td>
                                                <td><?php echo $row['jabatan'] ?></td>
                                                <td><?= number_format($masa_kerja, 2) ?></td>
                                                <td><?php echo $row['keterangan'] ?></td>
                                                <?php
                                                if ($role == 1) {
                                                    echo "<td>" . $row['catatan'] . "</td>";
                                                }
                                                ?>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="ubah?id=<?= urlencode(base64_encode($row['id'])); ?>">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>

                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="hapus?id=<?= urlencode(base64_encode($row['id'])); ?>">
                                                        <i class="fas fa-trash">
                                                        </i>

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
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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