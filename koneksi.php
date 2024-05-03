<?php 
$koneksi = new mysqli("localhost", "root", "", "yasumiport");
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
?>