<?php include '../koneksi.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YasumiPort</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>

    <table class="table table-dark table-striped mt-3">
        <tr>
            <th>No</th>
            <th>Pictutes</th>
            <th>Nama tempat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $i=1;
        $query = $koneksi->query("SELECT * FROM tempat_wisata");
        while ($data = $query->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td><img src='img/".$data['foto_tempat']."' width='200px' height='200px'></td>";
            echo "<td>".$data['nama_tempat']."</td>";
            echo "<td><a href='edit_tempat.php?id_tempat=".$data['id_tempat']."'>Edit</a> | <a href='hapus_tempat.php?id_tempat=".$data['id_tempat']."'>Hapus</a></td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>