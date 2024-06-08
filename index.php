<?php

include 'admin/layout/navbar.php';

if(isset($_SESSION['pesan'])){
    echo "<div class='alert alert-success alert-dismissible mt-3'>"
    .$_SESSION['pesan'].
    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    unset($_SESSION['pesan']);
}

$query = $koneksi->query("SELECT * FROM tempat_wisata")
?>


<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Album example</h1>
        <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>
  <form id="search-form" class="input-group mb-3" >
        <input type="text" name="search" placeholder="Search" class="input-group-text search" id="search-costumer">
    </form>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div id="card-tempat" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php while ($data = $query->fetch_assoc()):?>
        <div class="col">
          <div class="card shadow-sm">
            <img src="admin/tempat/img/<?= htmlspecialchars($data['foto_tempat'], ENT_QUOTES, 'UTF-8'); ?>" class="bd-placeholder-img card-img-top" width="100%" height="225">
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
      </div>

    <?php include 'admin/layout/footer.php';?>