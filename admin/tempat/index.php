    <?php include '../layout/navbar.php';
   
    if (!isset($_SESSION['username'])) {
        header('Location: ../../views/login/login.php');
        exit();
    }

    if ($_SESSION['role'] !== 'admin') {
        header('Location: ../../views/tolak/tolak.php'); // Buat halaman akses_ditolak.php yang memberi tahu pengguna bahwa akses ditolak
        exit();
    }


    if(isset($_GET['id_tempat'])){
        if(!isset($_SESSION['username'])){
            header('Location: ../../views/login/login.php');
        }
        $result = $tempatController->deleteTempat($koneksi);
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
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger alert-dismissible mt-3'>"
        .$_SESSION['error'].
        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        unset($_SESSION['error']);
    }

    // Pagination logic
$limit = 10; // Jumlah data perhalaman

//hitung jumlah total data
$total_query = $koneksi->query("SELECT COUNT(*) AS total FROM tempat_wisata");
if ($total_query === false) {
    die("Error: " . $koneksi->error);
}
$total_data = $total_query->fetch_assoc()['total'];

//hitung total jumlah alaman
$total_pages = ceil($total_data / $limit);

//tentukan halaman saat ini
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Menghindari halaman negatif
if ($page > $total_pages) $page = $total_pages; // Menghindari halaman lebih dari total halaman
$current_page = $page;

//hitung offset data
$offset = ($page - 1) * $limit;

// Queri database dengan limit dan offset
$query = $koneksi->query("SELECT * FROM tempat_wisata LIMIT $limit OFFSET $offset");
if ($query === false) {
    die("Error: " . $koneksi->error);
}


// nomor urut
$no = ($page - 1) * $limit + 1;

    ?>

        <a href="create_tempat.php"><button type="button" class="btn btn-success my-3 mx-1">+ tambah</button></a>
        <a href="<?= $pdfPath ?>?report=tempatWisata" target="_blank"><button type="button" class="btn btn-danger my-3 pdf">Export PDF</button></a>

        <form id="search-form" class="input-group mb-3" >
            <input type="text" name="search" placeholder="Search" class="input-group-text search" id="search-tempat">
        </form>

        <div id="table-tempat">
        <table class="table table-dark table-striped table-responsive table table-hover table-bordered tableku">
            <thead>
            <tr>
                <th>No</th>
                <th>Pictutes</th>
                <th>Nama tempat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // if (isset($_GET['search'])){
            //     $search = $_GET['search'];
            //     $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE nama_tempat LIKE '%$search%'");
            // }else{
            //     $query = $koneksi->query("SELECT * FROM tempat_wisata");
            // }
            
            $i=1;
            while ($data = $query->fetch_assoc()):
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td><img src='img/".htmlspecialchars($data['foto_tempat'])."' style='max-width: 400px; max-height: 400px;'></td>";
                echo "<td>".htmlspecialchars($data['nama_tempat'])."</td>";
                echo "<td>
                        <a href='edit_tempat.php?id_tempat=".htmlspecialchars($data['id_tempat'])."'><button type='button' class='btn btn-warning'><i class='bi bi-pen'></i></button></a> 
                        <a href='index.php?id_tempat=".htmlspecialchars($data['id_tempat'])."'><button type='button' class='btn btn-danger'><i class='bi bi-trash3'></i></button></a>   
                        <a href='view_tempat.php?id_tempat=".htmlspecialchars($data['id_tempat'])."'><button type='button' class='btn btn-primary'><i class='bi bi-eye'></i></button></a> </td>";
                echo "</tr>";
                ;
            endwhile;
            ?>
            </tbody>
        </table>
        </div>

        <!-- Pagination Links -->
<nav aria-label="page navigation">
    <ul class="pagination justify-content-center">
        <?php for($i = 1; $i <= $total_pages; $i++):?>
            <li class="page-item <?=($i == $current_page) ? 'active' : ''  ?>">
                <a href="?page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
         </li>
         <?php endfor; ?>
    </ul>
</nav>

    <?php include '../layout/footer.php'?>
<!-- </body>
</html> -->
    