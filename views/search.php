
<?php
include '../controller/koneksi.php';

$search = $_GET['search'];

$query = $koneksi->query("SELECT * FROM tempat_wisata
WHERE
nama_tempat LIKE '%$search%' OR
lokasi_tempat LIKE '%$search%' OR
deskripsi_tempat LIKE '%$search%'
");
?>
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

