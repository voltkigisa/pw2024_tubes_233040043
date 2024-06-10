<?php
 include '../layout/navbar.php';

 if(isset($_GET ['id_tempat'])){
    $id_tempat = $_GET['id_tempat'];
    $query = $koneksi->query("SELECT * FROM tempat_wisata 
   JOIN user ON tempat_wisata.id_user = user.id_user 
    WHERE id_tempat = '$id_tempat'");
    $data = $query->fetch_assoc();
    }

?>

<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center"><?= htmlspecialchars($data['nama_tempat']); ?></h4>
        </div>
        <div class="card-body">
            <div class="image text-center my-3">
                <img src="img/<?= htmlspecialchars($data['foto_tempat']); ?>" alt="Image" class="img-fluid rounded">
            </div>
            <div class="user mb-3">
                <span class="badge d-flex align-items-center p-2 text-primary-emphasis bg-primary border border-primary-subtle rounded-pill">
                    <img class="rounded-circle me-2" width="24" height="24" src="../../assets/img/<?= htmlspecialchars($data['gambar_user']) ?>" alt="User Image">
                    Created by: <?= htmlspecialchars($data['username']); ?>
                </span>
            </div>
            <div class="description mb-3">
                <h5>Description:</h5>
                <p><?= nl2br(htmlspecialchars($data['deskripsi_tempat'])); ?></p>
            </div>
            <div class="location">
                <h5>Location:</h5>
                <p><?= htmlspecialchars($data['lokasi_tempat']); ?></p>
            </div>
        </div>
    </div>
</div>

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
        <a href="index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
        <?php else: ?>
        <a href="../../index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
        <?php endif; ?>

<?php include '../layout/footer.php';?>