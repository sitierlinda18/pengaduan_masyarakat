<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
     .table thead {
    background-color: black; /* Warna latar belakang hitam */
    color: white; /* Warna teks putih */
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  /* Gaya untuk kolom tanggal_pengaduan */
  td.tanggal-pengaduan {
    font-style: italic;
    color: #3366cc; /* Ubah warna sesuai keinginan */
  }

  /* Gaya untuk kolom isi_laporan */
  td.isi-laporan {
    max-width: 300px; /* Batasi lebar maksimum */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

  <!-- Sesuaikan path dengan lokasi file Bootstrap di proyek Anda -->
  <title>Tabel Pengaduan</title>
</head>
<body>
<body>
    <form action="" method="post">
    <br>
    <center><label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Enter keyword">
        <input type="submit" value="Search">
    </center>
<div class="container mt-4">
  <center>
  <div class="display-3 fs-4 fw-bolder mb-5">
  <span class="text-gradient d-inline">Tabel Masyarakat</span>
</div>
  </center>

  <table class="table">
  <thead class="thead-dark">
      <tr>
        <th>Tanggal Pengaduan</th>
        <th>Isi Laporan</th>
        <th>Gambar</th>
      </tr>
    </thead>

    <tbody>
    <?php
include "koneksi.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = mysqli_real_escape_string($koneksi, $_POST['search']);

    // Perform the search query
    $query = "SELECT * FROM pengaduan WHERE tgl_pengaduan LIKE '%$search%' OR isi_laporan LIKE '%$search%'";
    $result = mysqli_query($koneksi, $query);
} else {
    // If the form is not submitted, fetch all records
    $result = mysqli_query($koneksi, "SELECT * FROM pengaduan");
}

// Display the table rows
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['tgl_pengaduan'] . "</td>";
    echo "<td>" . $row['isi_laporan'] . "</td>"; 
    echo "<td><img src='upload/" . $row['gambar'] . "' width='100' height='100'></td>";
    
}
?>
    </tbody>
  </table>
</div>

<br> 
<center> <button type="button" class="btn btn-primary" onclick="location.href='formpengaduan.php'">Kembali</button> </center>
<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sesuaikan path dengan lokasi file Bootstrap di proyek Anda -->
</body>
</html>