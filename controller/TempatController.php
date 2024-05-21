<?php

class TempatController
{

    public function storeTempat($koneksi)
    {
        $nama_tempat = $_POST['nama_tempat'];
        $id_user = $_SESSION['id_user'];
        $deskripsi = $_POST['deskripsi_tempat'];
        $lokasi = $_POST['lokasi_tempat'];

        $foto_tempat = rand(0, 9999) . $_FILES['foto_tempat']['name'];
        $tmp = $_FILES['foto_tempat']['tmp_name'];
        $absolute_path = __DIR__ . '/../admin/tempat/img/' . $foto_tempat;
        $size = $_FILES['foto_tempat']['size'];
        $type = $_FILES['foto_tempat']['type'];

        //cek gambar apakah sesuai ketentuan
        if ($size < 1000000 && $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
            if (move_uploaded_file($tmp, $absolute_path)) {
                $query = $koneksi->query("INSERT INTO `tempat_wisata` (`id_tempat`,`id_user`, `nama_tempat`, `deskripsi_tempat`, `lokasi_tempat`, `foto_tempat`)
             VALUES (NULL, '$id_user', '$nama_tempat', '$deskripsi', '$lokasi', '$foto_tempat')");
                if ($query) {
                    return mysqli_affected_rows($koneksi);
                } else {
                    throw new Exception("Error executing query: " . $koneksi->error);
                }
            }
        }


        // if (!is_dir('../admin/tempat/img/')) {
        //     mkdir('../admin/tempat/img/', 0777, true);
        // }
    }


    function updateTempat($koneksi)
    {
        $id_tempat = $_POST['id_tempat'];
        $nama_tempat = $_POST['nama_tempat'];
        $deskripsi = $_POST['deskripsi_tempat'];
        $lokasi = $_POST['lokasi_tempat'];

        $foto_tempat_baru = $_FILES['foto_tempat_baru']['name'];
        $tmp = $_FILES['foto_tempat_baru']['tmp_name'];
        $path = __DIR__ . "/../admin/tempat/img/" . $foto_tempat_baru;
        $size = $_FILES['foto_tempat_baru']['size'];
        $type = $_FILES['foto_tempat_baru']['type'];

        if ($size < 1000000 && $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
            if (move_uploaded_file($tmp, $path)) {
                $query = $koneksi->query("UPDATE `tempat_wisata` SET `nama_tempat` = '$nama_tempat', `deskripsi_tempat` = '$deskripsi', `lokasi_tempat` = '$lokasi', `foto_tempat` = '$foto_tempat_baru' WHERE `tempat_wisata`.`id_tempat` = '$id_tempat'");
                if ($query) {
                    return mysqli_affected_rows($koneksi);
                } else {
                    throw new Exception("Error executing query: " . $koneksi->error);
                }
            }
        }
    }

    function deleteTempat($koneksi)
    {
        // Mendapatkan id_tempat dari query string
        $id_tempat = $_GET['id_tempat'];

        // Mencari nama file gambar yang berhubungan dengan id_tempat
        $result = $koneksi->query("SELECT foto_tempat FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
        if ($result) {
            $row = $result->fetch_assoc();
            $foto_tempat = $row['foto_tempat'];

            // Menghapus gambar dari direktori
            $file_path = __DIR__."/../admin/tempat/img/" . $foto_tempat;
            if (file_exists($file_path)) {
                unlink($file_path);
            } else {
                throw new Exception("File not found: " . $file_path);
            }

            $query = $koneksi->query("DELETE FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
            if ($query) {
                return mysqli_affected_rows($koneksi);
            } else {
                throw new Exception("Error executing query: " . $koneksi->error);
            }
        } else {
            throw new Exception("Error executing query: " . $koneksi->error);
        }
    }
}
