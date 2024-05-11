<?php 
$koneksi = new mysqli("localhost", "root", "", "pw2024_tubes_233040043");
if ($koneksi->connect_error) {
    die("Kobeksi ke Database gagal: ". $koneksi->connect_error);
}