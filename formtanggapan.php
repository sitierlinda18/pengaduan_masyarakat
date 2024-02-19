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
$id_pengaduan = $isi_laporan = $tgl_pengaduan = "";

if (isset($_GET['id'])) {
    $id_pengaduan = $_GET['id'];
    $result_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan=$id_pengaduan");
    while ($data_pengaduan = mysqli_fetch_array($result_pengaduan)){
        $tgl_pengaduan = $data_pengaduan['tgl_pengaduan'];
        $isi_laporan = $data_pengaduan['isi_laporan'];
    }
}

if (isset($_POST['submit'])) {
    // Menggunakan $id_pengaduan dari GET pada blok pertama
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];

    $result = mysqli_query($koneksi, "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan) VALUES ('$id_pengaduan', '$tgl_tanggapan', '$tanggapan')");
    $hapus_peminjaman = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan=$id_pengaduan");
    if ($result) {
        header("Location: tabeltanggapan.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat menambahkan tanggapan: " . mysqli_error($koneksi);
    }
}


?>


<!-- Your HTML form goes here -->


<form action="" method="post">
    <center>
        <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline">Form Tanggapan Pengaduan</span></h1>
    </center>
    <label for="nik">Id Pengaduan:</label>
    <input type="number" id="id_pengaduan" name="id_pengaduan"  value="<?php echo $id_pengaduan;?>"readonly>

    <label for="isi_lporan">Isi Laporan:</label>
    <input type="text" id="isi_laporan" name="isi_laporan" value="<?php echo $isi_laporan;?>"readonly>

    <div class="form-group col-md-6">
                        <label for="tanggal">Tanggal Tanggapan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" id="tanggal" name="tgl_tanggapan">
                        </div>
                    </div>

    <label for="">Tanggapan:</label>
    <textarea id="tanggapan" name="tanggapan" rows="4" required></textarea>

    <button type="submit" name="submit" class="btn btn-primary mb-2">Kirim Pengaduan</button>
    <button type="reset" class="btn btn-danger mb-2">CANCEL</button>



</body>
</html>