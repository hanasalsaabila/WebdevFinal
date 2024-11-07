<!DOCTYPE html>
<html>

<?php
include "include/config.php";

if (isset($_POST['Simpan'])) {
    $hotel0165 = $_POST['kodehotel'];
    $hotelNAMA = $_POST['hotelnama'];
    $hotelALAMAT = $_POST['hotelalamat'];
    $kategori0165 = $_POST['kategorikode'];

        // Periksa apakah file foto diupload
        if(isset($_FILES['hotelFOTO']) && $_FILES['hotelFOTO']['error'] === UPLOAD_ERR_OK) {
            $hotelFOTO = $_FILES['hotelFOTO']['name'];
            $file_tmp = $_FILES["hotelFOTO"]["tmp_name"];
            $ekstensifile = pathinfo($hotelFOTO, PATHINFO_EXTENSION);
    
            // PERIKSA EKSTENSI FILE HARUS JPG ATAU JPEG
            if(in_array($ekstensifile, array("jpg", "jpeg"))) {
                move_uploaded_file($file_tmp, 'images/' . $hotelFOTO);
            } else {
                echo '<script>
                        alert("File foto harus dalam format JPG atau JPEG.");
                        window.location.href = "HotelHana.php";
                      </script>';
                exit; // Stop further execution
            }
        } else {
            // Jika file foto tidak diupload
            $hotelFOTO = ""; // Atur nilai default atau sesuaikan dengan kebutuhan Anda
        }

    $insert_query = "INSERT INTO hotel VALUES ('$hotel0165', '$hotelNAMA', '$hotelALAMAT', '$kategori0165', '$hotelFOTO')";
    if (mysqli_query($connection, $insert_query)) {
        echo "Data berhasil disimpan.";
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($connection);
    }
}

if (isset($_POST["KirimNama"])) {
    $searchNama = $_POST['SearchNama'];

    $query = mysqli_query($connection, "SELECT hotel.* FROM hotel 
            WHERE hotelNAMA LIKE '%$searchNama%'");
} 

else if (isset($_POST["KirimAlamat"])) {
    $searchAlamat = $_POST['SearchAlamat'];

    $query = mysqli_query($connection, "SELECT hotel.* FROM hotel 
            WHERE hotelALAMAT LIKE '%$searchAlamat%'");
} 

else {
    $query = mysqli_query($connection, "SELECT hotel.* FROM hotel");
}

$nomor = 1; 
?>

<head>
    <title>KUIS 7 NOVEMBER 2023</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<?php include "include/head.php"; ?>
    <body class="sb-nav-fixed">
        <?php include "include/menubar.php"; ?>
        <div id="layoutSidenav">
        <?php include "include/menunav.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

<body>

    <div class="row">
        <div class="col-sm-1"></div>

        <div class="col-sm-10">
        <form method="POST" enctype="multipart/form-data">

                <div class="mb-3 row">
                    <label for="kodehotel" class="col-sm-2 col-form-label">Kode Hotel</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="kodehotel" placeholder="Kode Hotel">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="hotelnama" class="col-sm-2 col-form-label">Nama Hotel</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="hotelnama" placeholder="Nama Hotel">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="hotelalamat" class="col-sm-2 col-form-label">Alamat Hotel</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="hotelalamat" placeholder="Alamat Hotel">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kategorikode" class="col-sm-2 col-form-label">Kode Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="kategorikode" placeholder="Kode Kategori">
                    </div>
                </div>

                <div class="form-group row mb-3">
    <label for="hotelFOTO" class="col-sm-2 col-form-label">Foto Hotel</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="hotelFOTO" name="hotelFOTO" accept="images/*">
    </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-7">
                        <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
                        <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
                    </div>
                </div>

            </form>

<form method="POST" style="margin-top: 20px;">
    <div class="form-group row mb-2">
        <label for="Search" class="col-sm-3">Nama Hotel</label>
        <div class="col-sm-6">
            <input type="text" name="SearchNama" class="form-control" id="SearchNama"
                value="<?php echo isset($_POST['SearchNama']) ? $_POST['SearchNama'] : ''; ?>"
                placeholder="Cari Nama Hotel">
        </div>
        <input type="Submit" name="KirimNama" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

<form method="POST" style="margin-top: 20px;">
    <div class="form-group row mb-2">
        <label for="Search" class="col-sm-3">Alamat Hotel</label>
        <div class="col-sm-6">
            <input type="text" name="SearchAlamat" class="form-control" id="SearchAlamat"
                value="<?php echo isset($_POST['SearchAlamat']) ? $_POST['SearchAlamat'] : ''; ?>"
                placeholder="Cari Alamat Hotel">
        </div>
        <input type="Submit" name="KirimAlamat" class="col-sm-1 btn btn-primary" value="Search">
    </div>
</form>

            <?php
            if (mysqli_num_rows($query) > 0) {
            ?>
                <div class="jumbotron mt-5">
                    <h1 class="display-5">Data Entri Hotel Hana</h1>
                    <table class="table">

<thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Kode Hotel</th>
        <th scope="col">Nama Hotel</th>
        <th scope="col">Alamat Hotel</th>
        <th scope="col">Kode Kategori</th>
        <th scope="col">Foto Hotel</th>
        <th colspan="2" style="text-align: center">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $row['hotel0165']; ?></td>
            <td><?php echo $row['hotelNAMA']; ?></td>
            <td><?php echo $row['hotelALAMAT']; ?></td>
            <td><?php echo $row['kategori0165']; ?></td>
            <td>
                <?php
                if (is_file("images/" . $row['hotelFOTO'])) {
                    echo "<img src='images/{$row['hotelFOTO']}' alt='Foto Hotel' style='max-width: 100px; max-height: 100px;'>";
                } else {
                    echo "<img src='images/noimage.png' alt='No Image' style='max-width: 100px; max-height: 100px;'>";
                }
                ?>
            </td>
                            <td width="10px">
                            <a href="destinasiedit.php?ubah=<?php echo $row["hotel0165"]?>" class ="btn btn-success btn-sm" title=" edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                            <td width="10px">
                            <a href="DeleteHotel.php?id=<?php echo $row["hotel0165"]; ?>" class="btn btn-danger btn-sm" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser-fill" viewBox="0 0 16 16">
                            <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
                            </svg>
                            </td>
                            </tr>
                            </td>
        </tr>
    <?php $nomor = $nomor + 1;
    } ?>
</tbody>

                    </table>
                </div>
            <?php } else {
                echo "Tidak ada hasil pencarian.";
            } ?>

        </div>
        </div>
                </main>
                <?php include "include/footer.php"; ?>
            </div>
        </div>
        <?php include "include/scriptjs.php"; ?>
    </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    </body>

    </html>