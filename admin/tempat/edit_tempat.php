<?php include '../layout/navbar.php' ?>

<?php 
if(isset($_GET ['id_tempat'])){
    $id_tempat = $_GET['id_tempat'];
    $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
    $data = $query->fetch_assoc();
}
?>

<h1>Edit Tempat Wisata</h1>
<a href="index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
<br>
<div class='mb-3 d-flex flex-column'>
    <label for="foto_tempat_lama" class="form-label">Foto Tempat Lama</label>
    <img src="img/<?php echo isset($data) ? $data['foto_tempat'] : ''; ?>" class="img img-thumbnail" alt="">
</div>

    <form method="POST" enctype="multipart/form-data" action="../../controller/TempatController.php">
        <input type="hidden" name="id_tempat" value="<?php echo isset($data) ? $data['id_tempat'] : '';?>">

        <div class="mb-3">
            <label for="nama_tempat" class="form-label">Nama Tempat</label>
            <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" value="<?php echo isset($data) ? $data['nama_tempat'] : '';?>">
        </div>
        <div class="mb-3">
            <label for="deskripsi_tempat" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi_tempat" name="deskripsi_tempat" rows="3"><?php echo isset($data) ? $data['deskripsi_tempat'] : '';?></textarea>
        </div>
        <div class="mb-3">
            <label for="lokasi_tempat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="lokasi_tempat" name="lokasi_tempat" value="<?php echo isset($data) ? $data['lokasi_tempat'] : '';?>">
        </div>
        <div class="mb-3">
            <label for="foto_tempat_baru" class="form-label">Foto Tempat Baru</label>
            <input type="file" class="form-control" id="foto_tempat_baru" name="foto_tempat_baru">
        </div>
        <input type="submit" class="btn btn-success" name="updateTempat" value="submit">
    </form>


<?php include '../layout/footer.php' ?>