<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hotel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<?php
include "include/config.php";
ob_start();
session_start();
if (!isset($_SESSION['useremail']))
    header("location:login.php");
?>
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

                    <?php
                    if (isset($_GET['ubah'])) {
                        $kodeToUpdate = $_GET['ubah'];
                        $result = mysqli_query($connection, "SELECT * FROM hotel WHERE hotel0165 = '$kodeToUpdate'");
                        $data = mysqli_fetch_array($result);
                    }

                    if (isset($_POST['Update'])) {
                        $hotel0165 = $_POST['kodehotel'];
                        $hotelNAMA = $_POST['hotelnama'];
                        $hotelALAMAT = $_POST['hotelalamat'];
                        $kategori0165 = $_POST['kategorikode'];

                        $updateQuery = "UPDATE hotel SET hotelNAMA = '$hotelNAMA', hotelALAMAT = '$hotelALAMAT', kategori0165 = '$kategori0165' WHERE hotel0165 = '$hotel0165'";
                        mysqli_query($connection, $updateQuery);
                        header("location:HotelHana.php");
                    }
                    ?>

                    <form method="POST">

                        <div class="mb-3 row">
                            <label for="kodehotel" class="col-sm-2 col-form-label">Kode Hotel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kodehotel" value="<?php echo $data['hotel0165']; ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="hotelnama" class="col-sm-2 col-form-label">Nama Hotel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="hotelnama" value="<?php echo $data['hotelNAMA']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="hotelalamat" class="col-sm-2 col-form-label">Alamat Hotel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="hotelalamat" value="<?php echo $data['hotelALAMAT']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategorikode" class="col-sm-2 col-form-label">Kode Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kategorikode" value="<?php echo $data['kategori0165']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-7">
                                <input type="submit" class="btn btn-primary" value="Update" name="Update">
                                <a href="NamaFileAnda.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>

                    </form>

                </div>
            </main>
            <?php include "include/footer.php"; ?>
        </div>
    </div>
    <?php include "include/scriptjs.php"; ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</html>
