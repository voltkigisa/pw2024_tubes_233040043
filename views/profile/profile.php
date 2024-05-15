<?php include '../../admin/layout/navbar.php';
$userProfile = [
    'username' => $_SESSION['username'],
    'email' => 'user@example.com', // Sesuaikan dengan data dari database
    'role' => $_SESSION['role'],
    'profile_image' => 'path/to/profile_image.jpg' // Path ke gambar profil
];

// Jika data pengguna tidak ditemukan, arahkan ke halaman login
if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login') {
    header('Location: /pw2024_tubes_233040043/views/login/login.php');
    exit();
}
?>



</body>
</html>