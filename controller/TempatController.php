<?php 
include '../koneksi.php';
if(isset($_POST['storeTempat'])){
    $nama_tempat = $_POST['nama_tempat'];
    $deskripsi = $_POST['deskripsi_tempat'];
    $lokasi = $_POST['lokasi_tempat'];
    $foto_tempat = $_FILES['foto_tempat']['name'];
    $tmp = $_FILES['foto_tempat']['tmp_name'];
    $path = "../admin/tempat/img/".$foto_tempat;
    if(move_uploaded_file($tmp, $path)){
        $query = $koneksi->query("INSERT INTO `tempat_wisata` (`id_tempat`, `nama_tempat`, `deskripsi_tempat`, `lokasi_tempat`, `foto_tempat`) VALUES (NULL, '$nama_tempat', '$deskripsi', '$lokasi', '$foto_tempat')");
        if($query){
            echo "<script>alert('Data berhasil ditambahkan')</script>";
            echo "<script>location='../admin/tempat/index.php'</script>";
        }else{
            echo "<script>alert('Data gagal ditambahkan')</script>";
            echo "<script>location='../admin/tempat/create_tempat.php'</script>";
        }
    }
}

if(isset($_POST['updateTempat'])){
    $id_tempat = $_POST['id_tempat'];
    $nama_tempat = $_POST['nama_tempat'];
    $deskripsi = $_POST['deskripsi_tempat'];
    $lokasi = $_POST['lokasi_tempat'];
    $foto_tempat_baru = $_FILES['foto_tempat_baru']['name'];
    $tmp = $_FILES['foto_tempat_baru']['tmp_name'];
    $path = "../admin/tempat/img/".$foto_tempat_baru;
    if(move_uploaded_file($tmp, $path)){
        $query = $koneksi->query("UPDATE `tempat_wisata` SET `nama_tempat` = '$nama_tempat', `deskripsi_tempat` = '$deskripsi', `lokasi_tempat` = '$lokasi', `foto_tempat` = '$foto_tempat_baru' WHERE `tempat_wisata`.`id_tempat` = '$id_tempat'");
        if($query){
            echo "<script>alert('Data berhasil diubah')</script>";
            echo "<script>location='../admin/tempat/index.php'</script>";
            // echo "$nama_tempat ";
            // echo "$deskripsi ";
            // echo "$lokasi ";
            // echo "$foto_tempat_baru ";
            // echo "$path";
        }else{
            echo "<script>alert('Data gagal diubah')</script>";
            echo "<script>location='../admin/tempat/edit_tempat.php'</script>";
        }
    }
}
?>