<?php
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
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Uraian Pangkat</th>
                                            <th>SK Jabatan</th>
                                            <th>Unit Kerja</th>
                                            <th>Jabatan</th>
                                            <th>Masa Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $result = $pdo->query("SELECT A.id,A.nama, A.prodi, A.nim, A.tanggal_tampil, B.pegawai_status AS status FROM data_kerjapraktek A, data_kerjapraktek_status B WHERE A.id = B.data_kerjapraktek_id AND B.pegawai_status = 'Pending' AND A.prodi = '$prodi' ORDER BY A.id DESC");
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?php echo TanggalIndo($row['tanggal_tampil']) ?></td>
                                                <td><?php echo $row['nama'] ?></td>
                                                <td><?php echo $row['prodi'] ?></td>
                                                <td><?php echo $row['nim'] ?></td>

                                                <td><span class="<?php echo $class; ?>"><?php echo $row['status'] ?></span></td>
                                                <td>

                                                    <a href="<?php echo "pegawai-detail?id=" . urlencode(base64_encode($row['id'])); ?>" class="btn btn-info btn-xs">Lihat Detail</a>
                                                    <a href="<?php echo "pegawai-detail?id=" . urlencode(base64_encode($row['id'])); ?>" class="button gray"><i class="sl sl-icon-eye"></i></a>
                                                    <!--<a href="#" class="button gray"><i class="sl sl-icon-pencil"></i></a>-->
                                                    <!-- <a href="<?php echo "hapus?id=" . $row['id']; ?>" class="button gray"><i class="sl sl-icon-close"></i></a> -->
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