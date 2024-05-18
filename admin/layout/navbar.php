<?php require_once __DIR__ . '/../../controller/koneksi.php';
require_once __DIR__ . '/../../controller/TempatController.php';
require_once __DIR__ . '/../../controller/UserController.php';
session_start();
$tempatController = new TempatController();
$loginController = new UserController();

if (isset($_POST['logout'])) {
  $loginController->logout();
  header('Location: /pw2024_tubes_233040043/index.php');
}

$loginPath = '/pw2024_tubes_233040043/views/login/login.php';
$profilePath = '/pw2024_tubes_233040043/views/profile/profile.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YasumiPort | Admin Dashboard</title>

  <!-- CDN bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown link
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <!-- ini login logout dan profile -->
        <form method="POST" action="">
          <ul class="navbar-nav ">
            <?php if (!isset($_SESSION['username'])) : ?>
              <li class="nav-item pe-3">
                <a href="<?= $loginPath; ?>"><button type="button" class="btn btn-primary my-3">Login</button></a>
              </li>
            <?php else : ?>
              <li class="nav-item pe-3">
                <a href="<?= $profilePath; ?>"><button type="button" name="profile" class="btn btn-primary my-3">Profile</button></a>
              </li>
              <li class="nav-item ">
                <button type="submit" name="logout" class="btn btn-danger my-3">Logout</button>
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