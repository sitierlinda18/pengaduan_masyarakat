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

// Assuming 'id' is the parameter you are passing in the URL
$id = $_GET['id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have form fields named 'tgl_tanggapan' and 'tanggapan'
    $tgl_tanggapan_new = $_POST['tgl_tanggapan'];
    $tanggapan_new = $_POST['tanggapan'];

    // Update the tanggapan data
    $updateQuery = "UPDATE tanggapan SET tgl_tanggapan='$tgl_tanggapan_new', tanggapan='$tanggapan_new' WHERE id_tanggapan=$id";

    if (mysqli_query($koneksi, $updateQuery)) {
        header('location:tabeltanggapan.php');
        echo "Tanggapan updated successfully.";
    } else {
        echo "Error updating tanggapan: " . mysqli_error($koneksi);
    }
}

// Retrieve tanggapan data
$result = mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_tanggapan=$id");
if ($data = mysqli_fetch_array($result)) {
    $id_pengaduan = $data['id_pengaduan'];
    $tanggapan = $data['tanggapan'];
    $tgl_tanggapan = $data['tgl_tanggapan'];

    // Retrieve pengaduan data
    $result_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE id_pengaduan=$id_pengaduan");
    if ($data_pengaduan = mysqli_fetch_array($result_pengaduan)) {
        $tgl_pengaduan = $data_pengaduan['tgl_pengaduan'];
        $isi_laporan = $data_pengaduan['isi_laporan'];
    } else {
        // Handle the case where no data is found in pengaduan table
        echo "Error: Data not found in pengaduan table.";
    }
} else {
    // Handle the case where no data is found in tanggapan table
    echo "Error: Data not found in tanggapan table.";
}
?>
<!-- Your HTML form goes here -->
    <form action="" method="post">
        <center>
            <h1 class="display-3 fw-bolder mb-5"><span class="text-gradient d-inline">Edit Tanggapan</span></h1>
        </center>
        
        <label for="nik">Id Pengaduan:</label>
        <input type="number" id="id_pengaduan" name="id_pengaduan"  value="<?php echo $id_pengaduan;?>" readonly>

        <label for="isi_laporan">Isi Laporan:</label>
        <input type="text" id="isi_laporan" name="isi_laporan" value="<?php echo $isi_laporan;?>" readonly>

        <label for="">Tanggal Tanggapan:</label>
        <input type="date" class="form-control" id="tgl_tanggapan" name="tgl_tanggapan" value="<?php echo $tgl_tanggapan;?>">

        <label for="">Tanggapan:</label>
        <textarea id="tanggapan" name="tanggapan" rows="4" required><?php echo $tanggapan;?></textarea>

        <button type="submit" name="submit" class="btn btn-primary mb-2">Kirim Pengaduan</button>
        <button type="reset" class="btn btn-danger mb-2">CANCEL</button>
    </form>

</body>
</html>
     