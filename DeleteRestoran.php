<?php
include "include/config.php";

if (isset($_GET['hapus'])) {
    $menu_idToDelete = $_GET['hapus'];

    // Query to delete data
    $delete_query = "DELETE FROM menu_items WHERE menu_id = '$menu_idToDelete'";

    if (mysqli_query($connection, $delete_query)) {
        echo "Data berhasil dihapus.";
        header("Location: RestoranHana.php");
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($connection);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>