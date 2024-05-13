<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YasumiPort | Admin Dashboard</title>

    <!-- CDN bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include '../layout/navbar.php';
    require_once '../../controller/TempatController.php';

    $TempatController = new TempatController();

    session_start();
    if(isset($_GET['id_tempat'])){
        $result = $TempatController->deleteTempat($koneksi);
        if($result > 0){
            $_SESSION['pesan'] = "Data berhasil dihapus";
        }else{
            $_SESSION['pesan'] = "Data gagal dihapus";
        }
        header('Location: index.php');
        exit();
    }

    if(isset($_SESSION['pesan'])){
        echo "<div class='alert alert-success alert-dismissible mt-3'>"
        .$_SESSION['pesan'].
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        unset($_SESSION['pesan']);
    }
    ?>
    <section>
        <div id="main" class="m-5">
        <a href="create_tempat.php"><button type="button" class="btn btn-success my-3">+ tambah</button></a>

        <form action="" method="get" class="input-group mb-3" >
            <input type="text" name="search" placeholder="Search" class="input-group-text">
            <input type="submit" name="cari" value="Search" class="btn btn-secondary">
        </form>
        <table class="table table-dark table-striped table-responsive table table-hover table-bordered ">
            <tr>
                <th>No</th>
                <th>Pictutes</th>
                <th>Nama tempat</th>
                <th>Aksi</th>
            </tr>
            <?php
            if (isset($_GET['search'])){
                $search = $_GET['search'];
                $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE nama_tempat LIKE '%$search%'");
            }else{
                $query = $koneksi->query("SELECT * FROM tempat_wisata");
            }
            $i=1;
            while ($data = $query->fetch_assoc()):
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td><img src='img/".$data['foto_tempat']."' width='200px' height='200px'></td>";
                echo "<td>".$data['nama_tempat']."</td>";
                echo "<td><a href='edit_tempat.php?id_tempat=".$data['id_tempat']."'>Edit</a> | <a href='index.php?id_tempat=".$data['id_tempat']."'>Hapus</a> |  <a href='hapus_tempat.php?id_tempat=".$data['id_tempat']."'>Lihat</a> </td>";
                echo "</tr>";
                $i++;
            endwhile;
            ?>
        </table>
        </div>
    </section>
    <?php include '../layout/footer.php'?>
</body>
</html>
    