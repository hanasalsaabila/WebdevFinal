<?php
include "include/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus data
    $delete_query = "DELETE FROM hana WHERE hanaID = '$id'";
    
    if (mysqli_query($connection, $delete_query)) {
        echo "Data berhasil dihapus.";
        header("Location: UASHana.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($connection);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>