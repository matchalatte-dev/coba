<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "glowguide";

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Maaf, koneksi gagal: " . $conn->connect_error);
}
?>