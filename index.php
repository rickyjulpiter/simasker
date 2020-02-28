<?php
include 'koneksi.php';

session_start();
if ($_SESSION['status'] != "login") {
	header("location:login");
} else {
	header("location:beranda");
	$username = $_SESSION['username'];
	$nama = $_SESSION['nama'];
	$role = $_SESSION['role'];
}
