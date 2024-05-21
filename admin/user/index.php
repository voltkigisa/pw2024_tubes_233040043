<?php include '../layout/navbar.php';
   
   if (!isset($_SESSION['username'])) {
       header('Location: ../../views/login/login.php');
       exit();
   }

   if ($_SESSION['role'] !== 'admin') {
       header('Location: ../../views/tolak/bukanAdmin.php'); // Buat halaman akses_ditolak.php yang memberi tahu pengguna bahwa akses ditolak
       exit();
   }


   if(isset($_GET['id_tempat'])){
       if($_SESSION['status'] != 'login'){
           header('Location: ../../views/login/login.php');
       }
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

<div id="search-results" class="container mt-3"></div>
       <div id="search-results"></div>
       <a href="create_tempat.php"><button type="button" class="btn btn-success my-3">+ tambah</button></a>

       <form id="search-form" class="input-group mb-3" >
           <input type="text" name="search" placeholder="Search" class="input-group-text search" id="search">
           <button type="submit" class="btn btn-primary" id="tombolCari">Search</button>
       </form>

       <div id="table">
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
           
           
           $query =$koneksi ->query("SELECT * FROM tempat_wisata");
           $i=1;
           while ($data = $query->fetch_assoc()):
               echo "<tr>";
               echo "<td>".$i."</td>";
               echo "<td><img src='img/".$data['foto_tempat']."' width='200px' height='200px'></td>";
               echo "<td>".$data['nama_tempat']."</td>";
               echo "<td>
                       <a href='edit_tempat.php?id_tempat=".$data['id_tempat']."'><button type='button' class='btn btn-warning'>Edit</button></a> 
                       <a href='index.php?id_tempat=".$data['id_tempat']."'><button type='button' class='btn btn-danger'>Hapus</button></a>   
                       <a href='hapus_tempat.php?id_tempat=".$data['id_tempat']."'><button type='button' class='btn btn-primary'>Lihat</button></a> </td>";
               echo "</tr>";
               $i++;
           endwhile;
           ?>
           </tbody>
       </table>
       </div>

   <?php include '../layout/footer.php'?>
<!-- </body>
</html> -->
   