<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan Masyarakat</title>
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

        form {
            background-color: #E5D4FF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
<?php
 include "koneksi.php";
// Create record
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $tgl_pengaduan = $_POST['tgl_pengaduan'];
    $isi_laporan = $_POST['isi_laporan'];
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path ="upload/" .$gambar;
    
    move_uploaded_file($gambar_tmp, $gambar_path);

    // Validate and sanitize user input before using in SQL query
    // ...

    $sql_masyarakat = "INSERT INTO masyarakat (nama, telp) VALUES ('$nama', '$telp')";
    $sql_pengaduan = "INSERT INTO pengaduan (nik, tgl_pengaduan, isi_laporan,gambar) VALUES ('$nik', '$tgl_pengaduan', '$isi_laporan', '$gambar')";

    
    $koneksi->query($sql_masyarakat);
    $koneksi->query($sql_pengaduan);
    if ($sql_masyarakat) {
      // jika berhasil, alihkan ke tabeltanggapan.php
      header("location: tabelmasyarakat.php");
      exit;
    }else {
      echo "Terjadi kesalahan saat menambahkan tanggapan"; 
    }
    }

// Update record (if needed)
// ...

// Delete record (if needed)
// ...


?>

<form action="" method="post" enctype="multipart/form-data">
    <center>
        <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline">Form Pengaduan</span></h1>
    </center>
    <label for="nik">NIK:</label>
    <input type="text" id="nik" name="nik" required>

    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="no_telp">Nomor Telepon:</label>
    <input type="text" id="telp" name="telp" required>

    <label for="tgl_pengaduan">Tanggal Pengaduan:</label>
    <input type="date" id="tgl_pengaduan" name="tgl_pengaduan" required>

    <label for="isi_laporan">Isi laporan:</label>
    <textarea id="isi_laporan" name="isi_laporan" rows="4" required></textarea>

    <label for="InputImage" style="color: grey; margin-right: 10px;">Gambar<label>
    <input type="file" class="form-control-file" id="InputImage" name="gambar" style="padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;">

    <button type="submit" name="submit">Kirim Pengaduan</button>
    <button type="reset" class="btn btn-danger mb-2">CANCEL</button>

    <br>
    <center><a href="tabelmasyarakat.php"> Lihat pengaduan lainnya </a></center>
</form>


</body>
</html>