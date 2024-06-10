<?php

include 'admin/layout/navbar.php';

$userId = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

if(isset($_SESSION['pesan'])){
    echo "<div class='alert alert-success alert-dismissible mt-3'>"
    .$_SESSION['pesan'].
    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    unset($_SESSION['pesan']);
}
if(isset($_SESSION['error'])){
    echo "<div class='alert alert-danger alert-dismissible mt-3'>"
    .$_SESSION['error'].
    "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    unset($_SESSION['error']);
}

$query = $koneksi->query("SELECT * FROM tempat_wisata");

if(isset($_GET['id_tempat'])){
    if(!isset($_SESSION['id_user'])){
        header('Location: ../../views/login/login.php');
    }
    $result = $tempatController->deleteTempat($koneksi);
    if($result > 0){
        $_SESSION['pesan'] = "Data berhasil dihapus";
    }else{
        $_SESSION['pesan'] = "Data gagal dihapus";
    }
    header('Location: index.php');
    exit();
}
?>


<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/carousel/Akihabara.jpg" class="d-block w-100" alt="">
    </div>
    <div class="carousel-item">
      <img src="assets/img/carousel/FushimiInariTaishashrine.jpg" class="d-block w-100" alt="">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
          
  <a href="admin/tempat/create_tempat.php" class="btn btn-success my-2">+ Tambah</a>
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
            <h5 class="card-title"><?= htmlspecialchars($data['nama_tempat']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($data['lokasi_tempat']) ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="admin/tempat/view_tempat.php?id_tempat=<?= htmlspecialchars($data['id_tempat']);?>"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                  <?php if ($userId && $data['id_user'] == $userId):?>
                  <a href="admin/tempat/edit_tempat.php?id_tempat=<?= htmlspecialchars($data['id_tempat']) ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                  <a href="?id_tempat=<?= htmlspecialchars($data['id_tempat']) ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Hapus</button></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php endwhile; ?>
      </div>

    <?php include 'admin/layout/footer.php';?>