<?php include '../../admin/layout/navbar.php'; 
if (!isset($_SESSION['id_user'])){
    header('Location: /pw2024_tubes_233040043/views/login/login.php');
    exit();
}
$id_user = $_SESSION['id_user'];

$query = $koneksi->prepare("SELECT * FROM user WHERE id_user = ?");
$query->bind_param("i", $id_user);
$query->execute();
$result = $query->get_result();
$data = $result->fetch_assoc();

if (isset($_POST['logout'])) {
    $loginController->logout();
    header('Location: /pw2024_tubes_233040043/index.php');
  }
?>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Profil Pengguna</h4>
                    </div>

                    <div class="card-body text-center">
                        <img src="<?= $data['gambar_user'] ?? '../../assets/img/default.png'; ?>" alt="Foto Profile" class="rounded-circle" width="150">
                        <h5 class="mt-3"><?= htmlspecialchars($data['username'] ?? 'N/A'); ?></h5>
                        <p>Email: <?= htmlspecialchars($data['email'] ?? 'N/A'); ?></p>
                        <p>Role: <?= htmlspecialchars($data['role'] ?? 'N/A'); ?></p>
                        <a href="#" class="btn btn-primary">Edit Profil</a>
                        <form method="POST" action="">
                            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../../admin/layout/footer.php' ?>