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
  <title>Tabel Tanggapan</title>
</head>
<body>
<form action="" method="post">
  <br>
  <center><label for="search">Search:</label>
<input type="text" id="search" name="search" placeholder="Enter Keyword">
<input type="submit" value="Search"> <center>
  
<div class="container mt-4">
  <center>
  <div class="display-3 fs-4 fw-bolder mb-5">
  <span class="text-gradient d-inline">Tabel Masyarakat</span>
</div>
  </center>

  <table class="table">
  <thead class="thead-dark">
      <tr>
        <th>Id Tanggapan</th>
        <th>Id Pengaduan</th>
        <th>Tanggal Tanggapan</th>
        <th>Tanggapan</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php
        include "koneksi.php";
        $tampil = "";

        if (isset($_POST['search'])) {
          $search = mysqli_real_escape_string($koneksi, $_POST['search']);
          $query ="SELECT * FROM tanggapan WHERE 
          id_tanggapan LIKE '%$search%' OR
          id_pengaduan LIKE '%$search%' OR
          tgl_tanggapan LIKE '%$search%' OR
          tanggapan LIKE '%$search%'";
          $tampil = mysqli_query($koneksi, $query);
        } else {
            $tampil = mysqli_query($koneksi, "SELECT * FROM tanggapan");
        }

        while ($row = mysqli_fetch_array($tampil)) {
            echo "<tr>";
            echo "<td>" . $row['id_tanggapan'] . "</td>";
            echo "<td>" . $row['id_pengaduan'] . "</td>";
            echo "<td>" . $row['tgl_tanggapan'] . "</td>";
            echo "<td>" . $row['tanggapan'] . "</td>";
            echo "<td><a href='edittanggapan.php?id=" . $row['id_tanggapan'] . "'>Edit</a> | <a href='hapustanggapan.php?id_tanggapan=" . $row['id_tanggapan'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
      ?>
       
    </tbody>
  </table>
  <center><button class="btn btn-danger mb-2" onclick="location.href='logout.php'">LOGOUT</button>
</div>

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sesuaikan path dengan lokasi file Bootstrap di proyek Anda -->
</body>
</html>