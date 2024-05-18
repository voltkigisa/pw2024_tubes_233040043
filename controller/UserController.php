<?php
class UserController
{

    public function register($koneksi)
{
    if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email'])) {
        echo "<script>alert('Username, Password, dan Email harus diisi')</script>";
        return;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'costomer'; // Sesuaikan dengan enum di tabel

    // Proses upload gambar
    if (isset($_FILES['gambar_user']) && $_FILES['gambar_user']['error'] == 0) {
        $gambar_user = rand(0, 9999) . $_FILES['gambar_user']['name'];
        $tmp = $_FILES['gambar_user']['tmp_name'];
        $absolute_path = __DIR__ . '/../assets/img/' . $gambar_user;
        $size = $_FILES['gambar_user']['size'];
        $type = $_FILES['gambar_user']['type'];

        // Cek ukuran dan tipe file gambar
        if ($size < 1000000 && ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg')) {
            if (move_uploaded_file($tmp, $absolute_path)) {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                // Menggunakan prepared statement untuk menghindari SQL injection
                $stmt = $koneksi->prepare("INSERT INTO user (username, password, email, gambar_user, role) VALUES (?, ?, ?, ?, ?)");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($koneksi->error));
                }

                $stmt->bind_param("sssss", $username, $passwordHash, $email, $gambar_user, $role);
                if ($stmt->execute()) {
                    header('Location: ../login/login.php');
                    return mysqli_affected_rows($koneksi);
                } else {
                    throw new Exception("Error executing query: " . $stmt->error);
                }
            } else {
                echo "<script>alert('Gagal mengupload gambar')</script>";
            }
        } else {
            echo "<script>alert('Ukuran atau tipe gambar tidak sesuai')</script>";
        }
    } else {
        echo "<script>alert('Gambar harus diupload')</script>";
    }
}


    public function login($koneksi)
    {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "<script>alert('Username dan Password harus diisi')</script>";
            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        //mengunakan prepared statement untuk menghindari sql injection
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($koneksi->error));
        }

        // $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();

            if (password_verify($password, $data['password'])) {

            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            // Redirect sesuai dengan role
            if ($_SESSION['role'] == 'admin') {
                header('Location: ../../admin/tempat/index.php');
                $_SESSION['pesan'] = "Berhasil login";
            } else {
                header('Location: ../../index.php');
            }
            exit();
        } else {
            echo "<script>alert('Username atau Password salah')</script>";
        }
    }
        return mysqli_affected_rows($koneksi);
    }


    public function logout()
    {
        session_start();
        session_destroy();
    }
}
