<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = $pdo->prepare("SELECT * FROM user WHERE username=:username AND password=:password");
$sql->bindParam(':username', $username);
$sql->bindParam(':password', $password);
$sql->execute();
$data = $sql->fetch();

if (!empty($data)) {
	$_SESSION['username'] = $data['username'];
	$_SESSION['role'] = $data['role'];
	$_SESSION['status'] = "login";

	$idUser = $data['id'];
	header("location:../beranda");
} else { // Jika $data nya kosong
	echo "<script>
		    alert('Maaf, username atau password yang anda masukkan salah');
		    window.location.href='index';
		    </script>";
}
