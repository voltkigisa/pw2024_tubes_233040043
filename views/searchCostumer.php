<?php

include '../controller/koneksi.php';

$search = $_GET['search'];

$query = $koneksi->query("SELECT * FROM tempat_wisata
WHERE
nama_tempat LIKE '%$search%' OR
lokasi_tempat LIKE '%$search%' OR
deskripsi_tempat LIKE '%$search%'
");
?>

    <?php while ($data = $query->fetch_assoc()):?>
        <div class="col">
          <div class="card shadow-sm">
            <img src="/pw2024_tubes_233040043/admin/tempat/img/<?= htmlspecialchars($data['foto_tempat'], ENT_QUOTES, 'UTF-8'); ?>" class="bd-placeholder-img card-img-top" width="100%" height="225">
            <div class="card-body">
            <h5 class="card-title"><?= $data['nama_tempat'] ?></h5>
            <p class="card-text"><?= $data['deskripsi_tempat'] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php endwhile; ?>
