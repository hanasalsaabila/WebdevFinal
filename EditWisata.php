<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi Wisata</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body>
    <?php
    include 'include/config.php';
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
                            $result = mysqli_query($connection, "SELECT * FROM destinasi WHERE destinasiKODE = '$kodeToUpdate'");
                            $data = mysqli_fetch_array($result);
                        }

                        if (isset($_POST['Update'])) {
                            $destinasiKODE = $_POST['kodedestinasi'];
                            $destinasiNAMA = $_POST['namadestinasi'];
                            $kategoriKODE = $_POST['kodekategori'];

                            $updateQuery = "UPDATE destinasi SET destinasiNAMA = '$destinasiNAMA', kategoriKODE = '$kategoriKODE' WHERE destinasiKODE = '$destinasiKODE'";
                            mysqli_query($connection, $updateQuery);
                            header("location:WisataHana.php");
                        }
                        ?>

                        <form method="POST">
                            <div class="mb-3 row">
                                <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Destinasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kodedestinasi" id="kodedestinasi" value="<?php echo $data['destinasiKODE']; ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Destinasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="namadestinasi" id="namadestinasi" value="<?php echo $data['destinasiNAMA']; ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="kodekategori" class="col-sm-2 col-form-label">Kategori Wisata</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kodekategori" id="kodekategori">
                                        <option value="<?php echo $data['kategoriKODE']; ?>"><?php echo $data['kategoriKODE']; ?></option>
                                        <?php
                                        $datakategori = mysqli_query($connection, "SELECT * FROM kategoriwisata");
                                        while ($row = mysqli_fetch_array($datakategori)) {
                                        ?>
                                            <option value="<?php echo $row["kategoriKODE"] ?>">
                                                <?php echo $row["kategoriKODE"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="Update" value="Update" class="btn btn-primary">
                                        <a href="WisataHana.php" class="btn btn-secondary">Batal</a>
                                    </div>
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
</html>
