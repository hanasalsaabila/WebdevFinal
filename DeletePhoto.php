<?php
include "include/config.php";

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    // Query hapus data
    $delete_query = "DELETE FROM fotodestinasi WHERE fotodestinasiKODE = '$id'";
    
    if (mysqli_query($connection, $delete_query)) {
        echo "Data berhasil dihapus.";
        header("Location: PhotoHana.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($connection);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
