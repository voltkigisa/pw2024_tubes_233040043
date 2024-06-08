<?php
include '../controller/koneksi.php';

$search = $_GET['search'];

$query = $koneksi->query( "SELECT * FROM user
WHERE
username LIKE '%$search%' OR
email LIKE '%$search%'
");
?>
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
               echo "<td><img src='../../assets/img/".$data['gambar_user']."' width='200px' height='200px'></td>";
               echo "<td>".$data['username']."</td>";
               echo "<td>".$data['email']."</td>";
                echo "<td>".$data['role']."</td>";
               echo "<td>
                       <a href='edit_user_admin.php?id_user=".$data['id_user']."'><button type='button' class='btn btn-warning'>Edit</button></a> 
                       <a href='index.php?id_user=".$data['id_user']."'><button type='button' class='btn btn-danger'>Hapus</button></a>   
                       </td>";
               echo "</tr>";
            endwhile;
            ?>
            </tbody>
        </table>