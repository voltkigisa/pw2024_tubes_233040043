<?php require_once __DIR__.'/../../controller/koneksi.php'; ?>
<?php require_once __DIR__. '/../../controller/TempatController.php'; 
    session_start();
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
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
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

      <!-- //Menentukan URL basis dari dokumen root server web -->
    </div>
  </div>
  <?php $loginPath = '/pw2024_tubes_233040043/views/login/login.php';?>
  <div class="d-flex flex-row-reverse bd-highlight">
  <ul class="navbar-nav ms-auto">
    <?php if(!isset($_SESSION['status']) && $_SESSION['status'] !== 'login'): ?>
      <li class="nav-item" >
        <a class="nav-link " href="<?= $loginPath; ?>"><button type="button" class="btn btn-primary my-3">Login</button></a>
      </li>
      <?php else:?>
        <li class="nav-item">
        <a class="nav-link" href="profile.php"><button type="button" class="btn btn-primary my-3">Profil</button></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?= $loginPath; ?>"><button type="button" class="btn btn-danger my-3">Logout</button></a>
        </li>
      <?php endif; ?>
  </ul>
  </div>
</nav>
<section>
        <div id="main" class="m-5">