<?php 
include 'admin/layout/navbar.php';

if(isset($_SESSION['pesan'])){
    echo "<div class='alert alert-success alert-dismissible mt-3'>"
    .$_SESSION['pesan'].
    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    unset($_SESSION['pesan']);
}
?>


<div class="container">
    <h1 class="text-center">Daftar Tempat Wisata</h1>
    <a href="admin/tempat/create_tempat.php"><button type="button" class="btn btn-primary my-3">Tambah Tempat Wisata</button></a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = $koneksi->query("SELECT * FROM tempat_wisata");
            $no = 1;
            while($data = $query->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $data['nama_tempat'];?></td>
                <td><?php echo $data['deskripsi_tempat'];?></td>
                <td><?php echo $data['lokasi_tempat'];?></td>
                <td><img src="admin/tempat/img/<?php echo $data['foto_tempat'];?>" class="img img-thumbnail" alt=""></td>
                <td>
                    <a href="admin/tempat/edit_tempat.php?id_tempat=<?php echo $data['id_tempat'];?>"><button type="button" class="btn btn-warning">Edit</button></a>
                    <a href="admin/tempat/delete_tempat.php?id_tempat=<?php echo $data['id_tempat'];?>"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php include 'admin/layout/footer.php';?>