<?php
include "koneksi.php"; // Include your database connection file

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id_tanggapan'])) {
    $id_tanggapan = $_GET['id_tanggapan'];

    // SQL query to delete the record
    $delete_query = "DELETE FROM tanggapan WHERE id_tanggapan = '$id_tanggapan'";

    // Execute the query
    $result = mysqli_query($koneksi, $delete_query);

    if($result) {
        // Record deleted successfully, redirect to the table page or any other desired location
        header("Location: tabeltanggapan.php");
        exit();
    } else {
        // Display an error message if the deletion fails
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Redirect to the table page or any other desired location if the 'id' parameter is not set
    header("Location: tabeltanggapan.php");
    exit();
}

// Close the database connection
mysqli_close($koneksi);
?>