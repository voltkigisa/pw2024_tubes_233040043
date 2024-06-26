<?php require_once __DIR__ . '/../../controller/koneksi.php';
require_once __DIR__ . '/../../controller/TempatController.php';
require_once __DIR__ . '/../../controller/UserController.php';
session_start();
$tempatController = new TempatController();
$userController = new UserController();

if (isset($_POST['logout'])) {
  $userController->logout();
  header('Location: /pw2024_tubes_233040043/index.php');
}

// Tentukan halaman yang aktif
$activePage = 'home'; // Ubah nilai ini sesuai dengan halaman yang sedang aktif
$activePage = 'homeCustomer'; // Ubah nilai ini sesuai dengan halaman yang sedang



// Fungsi untuk menentukan kelas 'active'
function setActiveClass($page, $activePage) {
  return ($page === $activePage) ? 'active' : '';
}


$loginPath = '/pw2024_tubes_233040043/views/login/login.php';
$profilePath = '/pw2024_tubes_233040043/views/profile/profile.php';
$userPath = '/pw2024_tubes_233040043/admin/user/index.php';
$tempatPath = '/pw2024_tubes_233040043/admin/tempat/index.php';
$customerPath = '/pw2024_tubes_233040043/index.php';
$pdfPath = '/pw2024_tubes_233040043/controller/PdfController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YasumiPort</title>

  <!-- CDN bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/style.css">

  <!-- CDN Icons Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= $customerPath ?>">YasumiPort</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
          <li class="nav-item">
            <a class="nav-link <?= setActiveClass('homeCustomer', $activePage); ?>" aria-current="page" href="<?= $customerPath ?>"> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= setActiveClass('tempatwisata', $activePage); ?>" aria-current="page" href="<?= $tempatPath ?>"> Data Tempat Wisata</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= setActiveClass('user', $activePage); ?>" href="<?= $userPath ?>">Data User</a>
          </li>
          <?php }?>
        </ul>
       
        <!-- ini login logout dan profile -->
        <form method="POST" action="">
          <ul class="navbar-nav ">
            <?php if (!isset($_SESSION['username'])) : ?>
              <li class="nav-item pe-3">
                <a href="<?= $loginPath; ?>"><button type="button" class="btn btn-primary my-3">Login <i class="bi bi-box-arrow-in-right"></i></button></a>
              </li>
            <?php else : ?>
              <li class="nav-item pe-3">
                <a href="<?= $profilePath; ?>"><button type="button" name="profile" class="btn btn-primary my-3">Profile <i class="bi bi-person"></i></button></a>
              </li>
              <li class="nav-item ">
                <button type="submit" name="logout" class="btn btn-danger my-3">Logout <i class="bi bi-box-arrow-right"></i></button>
              </li>
            <?php endif; ?>
          </ul>
        </form>
      </div>
    </div>
    </div>
    </div>
    </div>

  </nav>
  <section>
        <div id="main" class="container">