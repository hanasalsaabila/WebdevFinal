<!DOCTYPE html>
<html lang="en">

<?php
ob_start();
session_start();
if (!isset($_SESSION['useremail'])) header("location:login.php");
?>
<?php include "include/head.php"; ?>

<body class="sb-nav-fixed">
    <?php include "include/menubar.php"; ?>
    <div id="layoutSidenav">
        <?php include "include/menunav.php"; ?>
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">

                    <h1 class="mt-4 mb-4">Edit Kategori Wisata</h1>

                    <?php
                    include "include/config.php";
                    if (isset($_GET['ubah'])) {
                        $kodeToUpdate = $_GET['ubah'];
                        $result = mysqli_query($connection, "SELECT * FROM kategoriwisata WHERE kategoriKODE = '$kodeToUpdate'");
                        $data = mysqli_fetch_array($result);
                    }

                    if (isset($_POST['Update'])) {
                        $kategoriKODE = $_POST['inputKategoriKode'];
                        $kategoriNAMA = $_POST['inputKategoriNama'];
                        $kategoriKET = $_POST['inputKategoriKeterangan'];
                        $kategoriREFERENCE = $_POST['inputKategoriReference'];

                        $updateQuery = "UPDATE kategoriwisata SET kategoriNAMA = '$kategoriNAMA', kategoriKET = '$kategoriKET', kategoriREFERENCE = '$kategoriREFERENCE' WHERE kategoriKODE = '$kategoriKODE'";
                        mysqli_query($connection, $updateQuery);
                        header("location:KategoriWisataHana.php");
                    }
                    ?>

                    <form method="POST">
                        <div class="mb-3 row">
                            <label for="kategoriKODE" class="col-sm-3 col-form-label">Kode Kategori Wisata</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategoriKODE" name="inputKategoriKode"
                                    value="<?php echo $data['kategoriKODE']; ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategoriNAMA" class="col-sm-3 col-form-label">Nama Kategori Wisata</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategoriNAMA" name="inputKategoriNama"
                                    value="<?php echo $data['kategoriNAMA']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategoriKET" class="col-sm-3 col-form-label">Keterangan Kategori Wisata</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategoriKET" name="inputKategoriKeterangan"
                                    value="<?php echo $data['kategoriKET']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="kategoriREFERENCE" class="col-sm-3 col-form-label">Referensi Kategori Wisata</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kategoriREFERENCE"
                                    name="inputKategoriReference" value="<?php echo $data['kategoriREFERENCE']; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <input class="btn btn-primary" type="submit" value="Update" name="Update">
                                <a href="KategoriWisataHana.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>

                </div>
            </main>
            <?php include "include/footer.php"; ?>
        </div>
    </div>
    </div>
    <?php include "include/scriptjs.php"; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkw7d6CVI2gb0GZJs9mL9zACVMpEyii9R25AIMZ4lWyAaw50jwO8g8n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
