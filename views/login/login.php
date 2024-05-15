<?php 
require_once '../../controller/koneksi.php';
require_once '../../controller/LoginController.php';

$loginController = new LoginController();

if(isset($_POST['login'])){
    $result = $loginController->login($koneksi);
    if($result > 0){
        $_SESSION['pesan'] = "Berhasil login";
    }else{
        $_SESSION['pesan'] = "gagal login";
    }
    header('Location: ../../admin/tempat/index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>