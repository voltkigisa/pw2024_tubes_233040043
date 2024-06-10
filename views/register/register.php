<?php 
session_start();
require_once '../../controller/koneksi.php';
require_once '../../controller/UserController.php';

$loginController = new UserController();

if(isset($_POST['register'])){
    $result = $loginController->register($koneksi);
    if ($result > 0) {
        $_SESSION['pesan'] = "Berhasil register";
        header('Location: ../login/login.php'); // Redirect ke halaman login
        exit();
    }elseif(isset($_SESSION['error'])){
        $_SESSION['pesan'] = "Ukuran atau tipe gambar tidak sesuai";
    }else{
        $_SESSION['pesan'] = "Gagal register";
    }
    header('Location: ../login/login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
<body>
    
    <div class="container p-5 ">
        <h1>Registrasi Pengguna</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- upload gambar -->
            <div class="form-group">
                <label for="gambar_user">Foto:</label>
                <input type="file" class="form-control" id="gambar_user" name="gambar_user" required>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3" name="register">Daftar</button>
        </form>
        
        <p>Sudah punya akun? <a href="../login/login.php">Login</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>