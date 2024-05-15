<?php 
class LoginController{
    public function login($koneksi){
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "<script>alert('Username dan Password harus diisi')</script>";
            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        //mengunakan prepared statement untuk menghindari sql injection
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ? AND password = ? LIMIT 1");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($koneksi->error));
        }

        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['status'] = 'login';
            header('Location: ../admin/tempat/index.php');
            return mysqli_affected_rows($koneksi);
        }else{
            echo "<script>alert('Username atau Password salah')</script>";
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: login.php');
    }
}
?>