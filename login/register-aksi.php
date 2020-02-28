<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$role = $_POST['role'];
$password = md5($_POST['password']);
$password_verif = md5($_POST['password_verif']);

$validasiPassword = "d41d8cd98f00b204e9800998ecf8427e"; // supaya string kosong yang sudah di md5 tetep bisa di compare di bawah

$sql = $pdo->prepare("SELECT username FROM user WHERE username=:username");
$sql->bindParam(':username', $username);
$sql->execute();
$data = $sql->fetch();
if ($password == $validasiPassword or $password_verif == $validasiPassword) {
	echo "<script>
	alert('Mohon periksa inputan anda');
	window.history.back();
	</script>";
} elseif ($password != $password_verif) {
	echo "<script>
	alert('Mohon periksa inputan anda');
	window.history.back();
	</script>";
} elseif (!empty($data)) {
	echo "<script>
	alert('Mohon gunakan username lainnya');
	window.history.back();
	</script>";
} else {
	$sql = $pdo->prepare("INSERT INTO user (username,password,role) VALUES (:username, :password, :role)");
	$sql->bindParam(':username', $username);
	$sql->bindParam(':password', $password);
	$sql->bindParam(':role', $role);
	$sql->execute();
	activityLog($pdo, $username, "Berhasil daftar " . $role, urlTrack());
	echo "<script>
			alert('Sukses! Silahkan Masuk');
			window.location.href='index';
			</script>";
}
