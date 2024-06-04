<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/koneksi.php';

if (isset($_GET['report'])) {
  $reportType = $_GET['report'];
  if ($reportType == 'tempatWisata') {
    reportTempatWisata($koneksi);
  } elseif ($reportType == 'user') {
    reportUser($koneksi);
  } else {
    echo "Invalid report type!";
  }
} else {
  echo "No report type specified!";
}

function reportTempatWisata($koneksi)
{
  $html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar tempat WIsata</title>

  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<h1>Daftar Tempat Wisata</h1>
<table class="pdf-reporting" cellspacing=0 cellpadding=10>
            <thead>
            <tr>
                <th>No</th>
                <th>Pictutes</th>
                <th>Nama tempat</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
            </tr>
            </thead>
            <tbody>';

  $i = 1;
  $query = $koneksi->query("SELECT * FROM tempat_wisata");
  while ($data = $query->fetch_assoc()) :
    $html .= '<tr>;
              <td>' . $i++ . '</td>;
              <td><img src="../admin/tempat/img/' . $data['foto_tempat'] . '" width="100px" height="100px"></td>;
              <td>' . $data['nama_tempat'] . '</td>;
              <td>' . $data['deskripsi_tempat'] . '</td>;
              <td>' . $data['lokasi_tempat'] . '</td>';

  endwhile;

  $html .= '</tbody>
</table>
</body>
</html>';


  $mpdf = new \Mpdf\Mpdf();
  $mpdf->WriteHTML($html);
  $mpdf->Output();
}

function reportUser($koneksi)
{
  $html = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Daftar tempat WIsata</title>
    
      <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    
    <body>
    <h1>Daftar Tempat Wisata</h1>
    <table class="pdf-reporting" cellspacing=0 cellpadding=10>
      <thead>
        <tr>
          <th>No</th>
          <th>Pictutes</th>
          <th>Nama user</th>
          <th>Email</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>';

  $i = 1;
  $query = $koneksi->query("SELECT * FROM user");
  while ($data = $query->fetch_assoc()) :
    $html .= '<tr>;
                  <td>' . $i++ . '</td>;
                  <td><img src="../assets/img/' . $data['gambar_user'] . '" width="100px" height="100px"></td>;
                  <td>' . $data['username'] . '</td>;
                  <td>' . $data['email'] . '</td>;
                  <td>' . $data['role'] . '</td>';

  endwhile;

  $html .= '</tbody>
    </table>
    </body>
    </html>';


  $mpdf = new \Mpdf\Mpdf();
  $mpdf->WriteHTML($html);
  $mpdf->Output();
}
