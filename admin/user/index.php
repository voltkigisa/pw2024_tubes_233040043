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
       $result = $userController->deleteUser($koneksi);
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

       <form id="search-form" class="input-group mb-3" >
           <input type="text" name="search" placeholder="Search" class="input-group-text search" id="search-user">       </form>

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
           
           
           $query =$koneksi ->query("SELECT * FROM user");
           $i=1;
           while ($data = $query->fetch_assoc()):
               echo "<tr>";
               echo "<td>".$i++."</td>";
               echo "<td><img src='../../assets/img/".$data['gambar_user']."' width='200px' height='200px'></td>";
               echo "<td>".$data['username']."</td>";
               echo "<td>".$data['email']."</td>";
                echo "<td>".$data['role']."</td>";
               echo "<td>
                       <a href='edit_user_admin.php?id_user=".$data['id_user']."'><button type='button' class='btn btn-warning'>Edit</button></a> 
                       <a href='index.php?id_user=".$data['id_user']."'><button type='button' class='btn btn-danger'>Hapus</button></a>   
                        </td>";
               echo "</tr>";
               ;
           endwhile;
           ?>
           </tbody>
       </table>
       </div>

   <?php include '../layout/footer.php'?>
   