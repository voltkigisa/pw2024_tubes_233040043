<?php include '../layout/navbar.php';

   
   if (!isset($_SESSION['username'])) {
       header('Location: ../../views/login/login.php');
       exit();
   }

   if ($_SESSION['role'] !== 'admin') {
       header('Location: ../../views/tolak/bukanAdmin.php'); // Buat halaman akses_ditolak.php yang memberi tahu pengguna bahwa akses ditolak
       exit();
   }


   if(isset($_GET['id_user'])){
       if($_SESSION['status'] != 'login'){
           header('Location: ../../views/login/login.php');
       }
   }

   if(isset($_SESSION['pesan'])){
       echo "<div class='alert alert-success alert-dismissible mt-3'>"
       .$_SESSION['pesan'].
       "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
       unset($_SESSION['pesan']);
   }

   // Pagination logic
$limit = 5; // Jumlah data perhalaman

//hitung jumlah total data
$total_query = $koneksi->query("SELECT COUNT(*) AS total FROM user");
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
$query = $koneksi->query("SELECT * FROM user LIMIT $limit OFFSET $offset");
if ($query === false) {
    die("Error: " . $koneksi->error);
}

// nomor urut
$no = ($page - 1) * $limit + 1;

   ?>

       <!-- pdf reporting -->
       <a href="<?= $pdfPath ?>?report=user" target="_blank"><button type="button" class="btn btn-danger my-3 pdf">Export PDF</button></a>
       
       <form id="search-form" class="input-group mb-3" >
           <input type="text" name="search" placeholder="Search" class="input-group-text search" id="search-user">
        </form>

       <div id="table-user">
       <table class="table table-dark table-striped table-responsive table table-hover table-bordered tableku">
           <thead>
           <tr>
               <th>No</th>
               <th>Pictutes</th>
               <th>Nama user</th>
               <th>Email</th>
               <th>Role</th>
               <th>Aksi</th>
           </tr>
           </thead>
           <tbody>
           <?php
           
           
           $i=1;
           while ($data = $query->fetch_assoc()):
               echo "<tr>";
               echo "<td>".$i++."</td>";
               echo "<td><img src='../../assets/img/".htmlspecialchars($data['gambar_user'])."' style='max-width: 400px; max-height: 400px;'></td>";
               echo "<td>".htmlspecialchars($data['username'])."</td>";
               echo "<td>".htmlspecialchars($data['email'])."</td>";
                echo "<td>".htmlspecialchars($data['role'])."</td>";
               echo "<td>
                       <a href='edit_user_admin.php?id_user=".htmlspecialchars($data['id_user'])."'><button type='button' class='btn btn-warning'><i class='bi bi-pen'></i></button></a> 
                    </td>";
               echo "</tr>";
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
   