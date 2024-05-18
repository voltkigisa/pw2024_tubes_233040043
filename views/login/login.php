<?php
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
    <button type="submit" name="login" class="btn btn-primary mt-3">Login</button>
    </form>
    <p class="mt-3">Jika tidak punya akun <a href="<?= $registerPath ?>">Registrasi dulu!</a></p>
    </div>
</body>

</html>