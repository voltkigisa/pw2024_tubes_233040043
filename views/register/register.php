<?php 
require_once '../../controller/koneksi.php';
require_once '../../controller/UserController.php';

$loginController = new UserController();

if(isset($_POST['register'])){
    $result = $loginController->register($koneksi);
    if($result > 0){
        $_SESSION['pesan'] = "Berhasil register";
    }else{
        $_SESSION['pesan'] = "gagal register";
    }
   
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            
            <button type="submit" class="btn btn-primary" name="register">Daftar</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
    
</body>
</html>