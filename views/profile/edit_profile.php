<?php include '../../admin/layout/navbar.php';

if (!isset($_SESSION['id_user'])) {
    var_dump($_SESSION);
}

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['submit'])) {
    $result = $userController->updateProfile($koneksi);
    if ($result > 0) {
        $_SESSION['pesan'] = "Data berhasil diubah";
    }
    if($_SESSION['role']== 'admin'){
    header('Location: ../../admin/user/index.php');
    }else{
    header('Location: ../../index.php');
    }
}

?>

<h1>Edit Profile</h1>
<a href="profile.php"><button type="button" class="btn btn-primary my-3">Kembali</button></a>
<br>
<div class='mb-3 d-flex flex-column'>
    <label for="foto_user_lama" class="form-label ">Foto anda saat ini</label>
    <img src="../../assets/img/<?= isset($data) ? $data['gambar_user'] : ''; ?>" class="img img-thumbnail" alt="" style="max-width: 350px; max-height: 350px;">
</div>

<form method="POST" enctype="multipart/form-data" action="">
    <input type="hidden" name="id_user" value="<?php echo isset($data) ? $data['id_user'] : ''; ?>">

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($data) ? $data['username'] : ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <textarea class="form-control" id="email" name="email" rows="3" required><?php echo isset($data) ? $data['email'] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="gambar_user_baru" class="form-label">Foto Baru</label>
        <input type="file" class="form-control" id="gambar_user_baru" name="gambar_user_baru">
    </div>
    <input type="submit" class="btn btn-success" name="submit" value="submit">
</form>


<?php include '../../admin/layout/footer.php' ?>