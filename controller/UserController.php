<?php
class UserController
{
    public function register($koneksi)
{
    if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email'])) {
        echo "<script>alert('Username, Password, dan Email harus diisi')</script>";
        return;
    }

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $role = 'costomer'; // Sesuaikan dengan enum di tabel

    // Proses upload gambar
    if (isset($_FILES['gambar_user']) && $_FILES['gambar_user']['error'] == 0) {
        $gambar_user = rand(0, 9999) . htmlspecialchars($_FILES['gambar_user']['name']);
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
                        $_SESSION['pesan'] = "Berhasil register";
                        header('Location: ../login/login.php'); // Redirect ke halaman login
                    return mysqli_affected_rows($koneksi);
                } else {
                    throw new Exception("Error executing query: " . $stmt->error);
                }
            } 
        } else {
            $_SESSION['error'] = 'Gambar harus diupload';
        }
    } else {
        $_SESSION['error'] = 'Ukuran atau tipe gambar tidak sesuai';
    }
}


    public function login($koneksi)
    {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            echo "<script>alert('Username dan Password harus diisi')</script>";
            return;
        }

        $username = htmlspecialchars($_POST['username']);
        $password =htmlspecialchars ($_POST['password']);

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
                $_SESSION['pesan'] = "Berhasil Login";
            } else {
                header('Location: ../../index.php');
                $_SESSION['pesan'] = "Berhasil Login";
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

    public function updateUserAdmin($koneksi)
    {
        $id_user = htmlspecialchars($_POST['id_user']);
        $role = htmlspecialchars($_POST['role']);

        $query = $koneksi->query("UPDATE `user` SET `role` = '$role' WHERE `user`.`id_user` = '$id_user'");
        if ($query) {
            return mysqli_affected_rows($koneksi);
        } else {
            throw new Exception("Error executing query: " . $koneksi->error);
        }
    }

    public function updateProfile($koneksi)
    {
        $id_user = htmlspecialchars($_POST['id_user']);
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
    
        // Ambil gambar lama dari database
        $stmt = $koneksi->prepare("SELECT gambar_user FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $gambar_user_lama = $user['gambar_user'];
        $stmt->close();
    
        // Periksa apakah ada gambar baru yang diupload
        if (!empty($_FILES['gambar_user_baru']['name'])) {
            $gambar_user_baru = rand(0, 9999) .htmlspecialchars($_FILES['gambar_user_baru']['name']);
            $tmp = $_FILES['gambar_user_baru']['tmp_name'];
            $path = __DIR__ . "/../assets/img/" . $gambar_user_baru;
            $size = $_FILES['gambar_user_baru']['size'];
            $type = $_FILES['gambar_user_baru']['type'];
    
            if ($size < 1000000 && ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg')) {
                if (!move_uploaded_file($tmp, $path)) {
                    throw new Exception("Error uploading file");
                } else {
                    // Hapus gambar lama dari penyimpanan
                    $oldImagePath = __DIR__ . "/../assets/img/" . $gambar_user_lama;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                throw new Exception("Invalid file type or size");
            }
        } else {
            $gambar_user_baru = $gambar_user_lama;
        }
    
        $query = $koneksi->prepare("UPDATE `user` SET `username` = ?, `email` = ?, `gambar_user` = ? WHERE `user`.`id_user` = ?");
        $query->bind_param("sssi", $username, $email, $gambar_user_baru, $id_user);
        if ($query->execute()) {
            return $query->affected_rows;
        } else {
            throw new Exception("Error executing query: " . $query->error);
        }
    }
}
