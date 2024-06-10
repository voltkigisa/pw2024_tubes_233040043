<?php include '../layout/navbar.php';
 if (!isset($_SESSION['username'])) {
    header('Location: ../../views/login/login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../../views/tolak/bukanAdmin.php'); // Buat halaman akses_ditolak.php yang memberi tahu pengguna bahwa akses ditolak
    exit();
}

    if(isset($_GET ['id_user'])){
        $id_user = $_GET['id_user'];
        $query = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
        $data = $query->fetch_assoc();
    }

    if(isset($_POST['submit'])){
        if($_SESSION['status'] != 'login'){
            header('Location: ../../views/login/login.php');
        }
        $result = $userController->updateUserAdmin($koneksi);
        if($result > 0){
            $_SESSION['pesan'] = "Data berhasil diubah";
        }else{
            $_SESSION['pesan'] = "Data gagal diubah";
        }
        header('Location: index.php');
    
    }

?>

<h1>Edit Tempat Wisata</h1>
<a href="index.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
<br>
<div class='mb-3 d-flex flex-column'>
    <label for="gambar_user" class="form-label ">Foto Profile</label>
    <img src="../../assets/img/<?php echo isset($data) ? $data['gambar_user'] : ''; ?>" class="img img-thumbnail" alt="" style="max-width: 350px; max-height: 350px;">
</div>

<div class="mb-3">
    <label for="username" class="form-label">Nama Tempat</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($data) ? $data['username'] : '';?>" readonly>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($data) ? $data['email'] : ''; ?>" readonly>
</div>

<form method="POST" enctype="multipart/form-data" action="">
    <input type="hidden" name="id_user" value="<?php echo isset($data) ? $data['id_user'] : '';?>">
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
            <option value="admin" <?php echo isset($data) && $data['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="costomer" <?php echo isset($data) && $data['role'] === 'costomer' ? 'selected' : ''; ?>>Customer</option>
        </select>
    </div>
    
    <input type="submit" class="btn btn-success" name="submit" value="submit">
</form>


<?php include '../layout/footer.php' ?>