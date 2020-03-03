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

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<?php include '../template/head.php'; ?>
<style>
    .dt-button {
        background-color: blue ! important;
        background-image: -webkit-linear-gradient(top, #17a2b8 0%, #17a2b8 100%) ! important;
        color: white ! important;
    }
</style>

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
                                <table id="example" class="table table-bordered table-striped display nowrap" style="width:100%">
                                    <!-- <table id="example1" class="table table-bordered table-striped text-center"> -->
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
                                                <?php
                                                $masa_kerja = number_format($masa_kerja, 2);
                                                if ($masa_kerja < 4) {
                                                    $color = "white";
                                                } elseif ($masa_kerja >= 4 and $masa_kerja < 6) {
                                                    $color = "yellow";
                                                } elseif ($masa_kerja >= 6) {
                                                    $color = "red";
                                                }

                                                ?>
                                                <td style="background-color: <?= $color ?>"><?= $masa_kerja ?></td>
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
        // $(function() {
        //     $("#example1").DataTable();
        //     $('#example2').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //     });
        // });
        // $(document).ready(function() {
        //     var buttonCommon = {
        //         exportOptions: {
        //             format: {
        //                 body: function(data, row, column, node) {

        //                     // Strip $ from salary column to make it numeric
        //                     return column === 2 ?
        //                         data = "'" + data : data;
        //                 }
        //             }
        //         }
        //     };
        //     $('#example1').DataTable({
        //         columns: [{
        //                 data: 'No'
        //             },
        //             {
        //                 data: 'Nama'
        //             },
        //             {
        //                 data: 'NIP'
        //             },
        //             {
        //                 data: 'Uraian Pangkat'
        //             },
        //             {
        //                 data: 'SK Jabatan'
        //             },
        //             {
        //                 data: 'Tanggal SK'
        //             },
        //             {
        //                 data: 'Unit Kerja'
        //             },
        //             {
        //                 data: 'Jabatan'
        //             },
        //             {
        //                 data: 'Masa Kerja'
        //             },
        //             {
        //                 data: 'Keterangan'
        //             },
        //             {
        //                 data: 'Aksi'
        //             }

        //         ],
        //         dom: 'Bfrtip',
        //         buttons: [
        //             $.extend(true, {}, buttonCommon, {
        //                 extend: 'copyHtml5'
        //             }),
        //             $.extend(true, {}, buttonCommon, {
        //                 extend: 'excelHtml5'
        //             })
        //         ]
        //     });
        // });


        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


    <!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script> -->
</body>

</html>