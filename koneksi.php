<?php
date_default_timezone_set('America/Los_Angeles');

// $host = "localhost";
// $username = "root";
// $password = "";
// $database = "simasker";

// Sistem Pintar Server
$host = "localhost";
$username = "u4502442_simasker";
$password = "m=eu4Z=QUmwn";
$database = "u4502442_simasker";

// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);

try {
	$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
} catch (PDOException $e) {
	exit("Error: " . $e->getMessage());
}

// Load function disini

include 'function.php';
