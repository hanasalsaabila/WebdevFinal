<?php
include "include/config.php";

if(isset($_GET['id'])){
    $hotel_id = $_GET['id'];

    // Query hapus data
    $delete_query = "DELETE FROM hotel WHERE hotel0165 = '$hotel_id'";
    
    if (mysqli_query($connection, $delete_query)) {
        echo "Data berhasil dihapus.";
        header("Location: HotelHana.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($connection);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>