<?php
include "include/config.php";

if (isset($_GET['ubah'])) {
    $kodeToUpdate = $_GET['ubah'];
    $result = mysqli_query($connection, "SELECT * FROM fotodestinasi WHERE fotodestinasiKODE = '$kodeToUpdate'");
    $data = mysqli_fetch_array($result);
}

if (isset($_POST['Update'])) {
    $kodefoto = $_POST['inputkode'];
    $namafoto = $_POST['inputnama'];

    // Check if a new file is uploaded
    if ($_FILES['file']['name'] != '') {
        $namafile = $_FILES['file']['name'];
        $file_tmp = $_FILES["file"]["tmp_name"];

        $ekstensifile = pathinfo($namafile, PATHINFO_EXTENSION);

        // PERIKSA EKSTEN FILE HARUS JPG ATAU jpg
        if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
            move_uploaded_file($file_tmp, 'images/' . $namafile);
            $updateQuery = "UPDATE fotodestinasi SET fotodestinasiNAMA = '$namafoto', fotodestinasiFILE = '$namafile' WHERE fotodestinasiKODE = '$kodefoto'";
        }
    } else {
        // If no new file is uploaded, update only the other fields
        $updateQuery = "UPDATE fotodestinasi SET fotodestinasiNAMA = '$namafoto' WHERE fotodestinasiKODE = '$kodefoto'";
    }

    mysqli_query($connection, $updateQuery);
    header("location:PhotoHana.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Photo Destinasi Wisata</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }

        .form-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .btn-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['useremail']))
        header ("location:login.php");
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
    <div class="container form-container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="display-4">Edit Photo Destinasi Wisata</h1>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <!-- Populate the form fields with existing data -->
            <div class="form-group row mb-3">
                <label for="kodefoto" class="col-sm-2 col-form-label">Kode Photo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodefoto" name="inputkode" placeholder="Kode Photo" maxlength="4" value="<?php echo $data['fotodestinasiKODE']; ?>" readonly>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="namafoto" class="col-sm-2 col-form-label">Nama Photo</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namafoto" name="inputnama" placeholder="Nama Photo" value="<?php echo $data['fotodestinasiNAMA']; ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="file" class="col-sm-2 col-form-label">Photo Wisata</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file">
                    <p class="help-block">Field ini digunakan untuk unggah file</p>
                </div>
            </div>

            <div class="form-group row btn-container">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" name="Update" class="btn btn-primary" value="Update">
                    <a href="photodestinasi.php" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
        </main>
                <?php include "include/footer.php"; ?>
            </div>
        </div>
        <?php include "include/scriptjs.php"; ?>
    </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    </body>

    </html>