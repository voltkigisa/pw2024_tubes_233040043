<?php include '../layout/navbar.php'?>

    <a href="create_tempat.php"><button type="button" class="btn btn-success my-3">+ tambah</button></a>
    <div class="vh-100">

    <form action="" method="get" class="input-group" >
        <input type="text" name="search" placeholder="Search" class="input-group-text">
        <input type="submit" name="cari" value="Search" class="btn btn-secondary">
    </form>
    <table class="table table-dark table-striped table-responsive table table-hover table-bordered">
        <tr>
            <th>No</th>
            <th>Pictutes</th>
            <th>Nama tempat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $i=1;
        if (isset($_GET['search'])){
            $search = $_GET['search'];
            $query = $koneksi->query("SELECT * FROM tempat_wisata WHERE nama_tempat LIKE '%$search%'");
        }else{
            $query = $koneksi->query("SELECT * FROM tempat_wisata");
        }
        while ($data = $query->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td><img src='img/".$data['foto_tempat']."' width='200px' height='200px'></td>";
            echo "<td>".$data['nama_tempat']."</td>";
            echo "<td><a href='edit_tempat.php?id_tempat=".$data['id_tempat']."'>Edit</a> | <a href='#' onclick='hapus(".$data['id_tempat'].")'>Hapus</a> |  <a href='hapus_tempat.php?id_tempat=".$data['id_tempat']."'>Lihat</a> </td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
    </div>
    

    <!-- fungsi hapus -->
    <script>
        function hapus(id_tempat){
            var yakin = confirm('Apakah anda yakin akan menghapus data ini?');
            if(yakin){
                window.location = 'index.php?id_tempat='+id_tempat;
            }
        }
    </script>
        <?php
        if(isset($_GET['id_tempat'])){
            $id_tempat = $_GET['id_tempat'];
            $query = $koneksi->query("DELETE FROM tempat_wisata WHERE id_tempat = '$id_tempat'");
            if($query){
                echo "<script>alert('Data berhasil dihapus')</script>";
                echo "<script>location='index.php'</script>";
            }
        }
        ?>
    <!-- akhir fungsi hapus -->

    <?php include '../layout/footer.php'?>
    
