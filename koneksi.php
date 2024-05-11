<?php 
$koneksi = new mysqli("localhost", "root", "", "pw2024_tubes_233040043");
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
?>