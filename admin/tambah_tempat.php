<?php include '../koneksi.php';?>
<?php 
if(isset($_GET ['id_tempat'])){
    $id_tempat = $_GET['id_tempat'];
    $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
    $data = $query->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YasumiPort | Edit Tempat</title>
</head>
<body>

    <h1>Edit Tempat</h1>
    <form action="proses_edit_tempat.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_tempat" value="<?php echo $data['id_tempat']?>">
        <input type="hidden" name="foto_tempat_lama" value="<?php echo $data['foto_tempat']?>">
        <label for="nama_tempat">Nama Tempat</label><br>
        <input type="text" name="nama_tempat" id="nama_tempat" value="<?php echo $data['nama_tempat']?>"><br>
        <label for="foto_tempat">Foto Tempat</label><br>
        <img src="img/<?php echo $data['foto_tempat']?>" width="200px" height="200px"><br>
        <input type="file" name="foto_tempat" id="foto_tempat"><br>
        <button type="submit">Edit</button>
    </form>
    
</body>
</html>