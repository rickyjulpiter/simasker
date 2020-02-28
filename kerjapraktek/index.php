<?php
if ($_SESSION['role'] == "pegawai") {
    header("location:../kerjapraktek/pegawai");
} elseif ($_SESSION['role'] == "koordinator") {
    header("location:../kerjapraktek/koordinator");
} elseif ($_SESSION['role'] == "kaprodi") {
    header("location:../surat_aka/kaprodi");
} elseif ($_SESSION['role'] == "dekan") {
    header("location:../surat_ket_aktif_kuliah/wd");
} else {
    header("location:data_kerjapraktek");
}
