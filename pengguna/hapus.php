<?php
include '../koneksi.php';
$id = urldecode(base64_decode($_GET['id']));

$sql = $pdo->prepare("DELETE FROM user WHERE id = :id");
$sql->bindParam(':id', $id);
if ($sql->execute()) {
	header("location:index");
} else {
	"<script>
		    alert('Maaf, ada kesalahan saat menghapus data');
		    window.location.href='index';
		    </script>";
}
