<?php include '../layout/navbar.php';
require_once '../../controller/TempatController.php';
require_once '../../controller/LoginController.php';

$tempatController = new TempatController();
$loginController = new LoginController();

    if(isset($_GET ['id_tempat'])){
        $id_tempat = $_GET['id_tempat'];
        $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
        $data = $query->fetch_assoc();
    }
    session_start();
    if(isset($_POST['submit'])){
        if($_SESSION['status'] != 'login'){
            header('Location: ../../views/login/login.php');
        }
        $result = $tempatController->updateTempat($koneksi);
        if($result > 0){
            $_SESSION['pesan'] = "Data berhasil diubah";
        }else{
            $_SESSION['pesan'] = "Data gagal diubah";
        }
        header('Location: index.php');
    
    }

?>

<h1>Edit Tempat Wisata</h1>
<a href="index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
<br>
<div class='mb-3 d-flex flex-column'>
    <label for="foto_tempat_lama" class="form-label">Foto Tempat Lama</label>
    <img src="img/<?php echo isset($data) ? $data['foto_tempat'] : ''; ?>" class="img img-thumbnail" alt="">
</div>

    <form method="POST" enctype="multipart/form-data" action="">
        <input type="hidden" name="id_tempat" value="<?php echo isset($data) ? $data['id_tempat'] : '';?>">

        <div class="mb-3">
            <label for="nama_tempat" class="form-label">Nama Tempat</label>
            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" value="<?php echo isset($data) ? $data['nama_tempat'] : '';?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_tempat" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi_tempat" name="deskripsi_tempat" rows="3" required><?php echo isset($data) ? $data['deskripsi_tempat'] : '';?></textarea>
        </div>
        <div class="mb-3">
            <label for="lokasi_tempat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="lokasi_tempat" name="lokasi_tempat" value="<?php echo isset($data) ? $data['lokasi_tempat'] : '';?>" required>
        </div>
        <div class="mb-3">
            <label for="foto_tempat_baru" class="form-label">Foto Tempat Baru</label>
            <input type="file" class="form-control" id="foto_tempat_baru" name="foto_tempat_baru">
        </div>
        <input type="submit" class="btn btn-success" name="submit" value="submit">
    </form>


<?php include '../layout/footer.php' ?>