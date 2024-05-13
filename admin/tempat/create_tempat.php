<?php include '../layout/navbar.php';
require_once '../../controller/TempatController.php';

$tempatController = new TempatController();

session_start();
if(isset($_POST['submit'])){
    $result = $tempatController->storeTempat($koneksi);
    if($result > 0){
        $_SESSION['pesan'] = "Data berhasil ditambahkan";
    }else{
        $_SESSION['pesan'] = "Data gagal ditambahkan";
    }
    header('Location: index.php');

}

?>
    <h1>Tambah Tempat Wisata</h1>
    <div class="container-create-tempat">
        <a href="index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>

        <form method="POST" action="" enctype="multipart/form-data">
        <!-- <input type="hidden" name="storeTempat" value="1"> -->

            <div class="mb-3">
                <label for="nama_tempat" class="form-label
                ">Nama Tempat</label>
                <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" value="" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_tempat" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi_tempat" name="deskripsi_tempat" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label for="lokasi_tempat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="lokasi_tempat" name="lokasi_tempat" value="" required>
            </div>
            <div class="mb-3">
                <label for="foto_tempat" class="form-label
                ">Foto Tempat</label>
                <input type="file" class="form-control" id="foto_tempat" name="foto_tempat" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

<?php include '../layout/footer.php';?>