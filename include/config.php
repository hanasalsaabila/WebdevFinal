<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "pesonajawa";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
