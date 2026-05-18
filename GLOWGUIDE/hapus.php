<?php
include 'auth_check.php';
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM konsultasi WHERE id='$id'");
header("Location: konsultasi.php");
exit();
?>