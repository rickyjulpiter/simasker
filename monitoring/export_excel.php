<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(0);
include '../koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pegawai.xls");
    ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Uraian Pangkat</th>
            <th>SK Jabatan</th>
            <th>Tanggal SK</th>
            <th>Unit Kerja</th>
            <th>Jabatan</th>
        </tr>
        <?php
        $no = 1;
        $result = $pdo->query("SELECT * FROM data_kerja LIMIT 200");
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
                <td><?php echo TanggalIndo($row['tanggal_sk']) ?></td>
                <td><?php echo $row['unit_kerja'] ?></td>
                <td><?php echo $row['jabatan'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>