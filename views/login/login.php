<?php
session_start();
require_once '../../controller/koneksi.php';
require_once '../../controller/UserController.php';

$loginController = new UserController();

if (isset($_POST['login'])) {
    $result = $loginController->login($koneksi);
}

$registerPath = '../register/register.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Login</h2>

        <?php if (isset($_SESSION['pesan'])): ?>
            <div class="alert alert-success alert-dismissible " role="alert">
                <?php echo $_SESSION['pesan']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
            <?php unset($_SESSION['pesan']); ?>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
    <button type="submit" name="login" class="btn btn-primary mt-3">Login <i class="bi bi-box-arrow-in-right"></i> </button>
    </form>
    <p class="mt-3">Jika tidak punya akun <a href="<?= $registerPath ?>">Registrasi dulu!</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>