<?php

class TempatController
{

    public function storeTempat($koneksi)
    {
        $nama_tempat = htmlspecialchars($_POST['nama_tempat']);
        $id_user = htmlspecialchars($_SESSION['id_user']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_tempat']);
        $lokasi = htmlspecialchars($_POST['lokasi_tempat']);

        $foto_tempat = rand(0, 9999) .htmlspecialchars( $_FILES['foto_tempat']['name']);
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
        $id_tempat = htmlspecialchars($_POST['id_tempat']);
        $nama_tempat = htmlspecialchars($_POST['nama_tempat']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_tempat']);
        $lokasi = htmlspecialchars($_POST['lokasi_tempat']);
    
        // Ambil foto lama dari database
        $stmt = $koneksi->prepare("SELECT foto_tempat FROM tempat_wisata WHERE id_tempat = ?");
        $stmt->bind_param("i", $id_tempat);
        $stmt->execute();
        $result = $stmt->get_result();
        $tempat = $result->fetch_assoc();
        $foto_tempat_lama = $tempat['foto_tempat'];
        $stmt->close();
    
        // Periksa apakah ada foto baru yang diupload
        if (!empty($_FILES['foto_tempat_baru']['name'])) {
            $foto_tempat_baru = rand(0, 9999) .htmlspecialchars($_FILES['foto_tempat_baru']['name']);
            $tmp = $_FILES['foto_tempat_baru']['tmp_name'];
            $path = __DIR__ . "/../admin/tempat/img/" . $foto_tempat_baru;
            $size = $_FILES['foto_tempat_baru']['size'];
            $type = $_FILES['foto_tempat_baru']['type'];
    
            if ($size < 1000000 && ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg')) {
                if (!move_uploaded_file($tmp, $path)) {
                    throw new Exception("Error saat mengupload file");
                } else {
                    // Hapus foto lama dari penyimpanan
                    $oldImagePath = __DIR__ . "/../admin/tempat/img/" . $foto_tempat_lama;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                throw new Exception("Tipe atau ukuran file tidak valid");
            }
        } else {
            $foto_tempat_baru = $foto_tempat_lama;
        }
    
        $query = $koneksi->prepare("UPDATE `tempat_wisata` SET `nama_tempat` = ?, `deskripsi_tempat` = ?, `lokasi_tempat` = ?, `foto_tempat` = ? WHERE `id_tempat` = ?");
        $query->bind_param("ssssi", $nama_tempat, $deskripsi, $lokasi, $foto_tempat_baru, $id_tempat);
        if ($query->execute()) {
            return $query->affected_rows;
        } else {
            throw new Exception("Error saat menjalankan query: " . $query->error);
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
