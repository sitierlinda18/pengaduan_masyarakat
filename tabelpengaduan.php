<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Pengaduan Masyarakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

button {
    background-color: #7360DF;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #EBC7E8;
}
    </style>
</head>
<body>
<div class="container mt-4">
  <center>
  <form method="get">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter keyword">
        <button type="submit">Search</button>
    </form>
    <div class="display-3 fw-bolder mb-5">
      <span class="text-gradient d-inline">Tabel Pengaduan</span>
    </div>
  </center>
   <center> <table>
        <thead>
            <tr>
                <th>id pengaduan</th>
                <th> NIK</th>
                <th>tanggal pengaduan</th>
                <th>isi laporan</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
          include "koneksi.php";

          // Check if the search parameter is provided
          $search = isset($_GET['search']) ? $_GET['search'] : '';

          // Construct the SQL query based on the search parameter
          $query = "SELECT * FROM pengaduan WHERE 
                     id_pengaduan LIKE '%$search%' OR
                     nik LIKE '%$search%' OR
                     tgl_pengaduan LIKE '%$search%' OR
                     isi_laporan LIKE '%$search%'";

          $tampil = mysqli_query($koneksi, $query);

          foreach ($tampil as $row) {
        ?>
        <tr>
          <td><?php echo "$row[id_pengaduan]"; ?></td>
          <td><?php echo "$row[nik]"; ?></td>
          <td><?php echo "$row[tgl_pengaduan]"; ?></td>
          <td><?php echo "$row[isi_laporan]"; ?></td>
          <td><img src="upload/<?php echo $row['gambar']; ?>" width="100" height="100"></td>
          <td><?php echo "<a href='formtanggapan.php?id=" . $row['id_pengaduan'] . "'>Tanggapi</a>"; ?></td>
        </tr>
        <?php } ?>

<div class="text-center text-xxl-start">
                                
        <tbody>
            <!-- Tambahkan baris sesuai dengan data pengaduan yang dimiliki -->
        </tbody>
    </table>
    <center><button class="btn btn-danger mb-2" onclick="location.href='logout.php'">LOGOUT</button>
</body>
</html>