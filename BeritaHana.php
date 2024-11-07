<?php
  include "include/config.php";
  if (isset($_POST["Simpan"])) {
    $kategoriberitaKODE = $_POST["InputKategoriKode"];
    $kategoriberitaNAMA = $_POST["InputKategoriNama"];
    $kategoriberitaKET = $_POST["InputKategoriKet"];

    $query = "INSERT INTO berita (kategoriberitaKODE, kategoriberitaNAMA, kategoriberitaKET) VALUES ('$kategoriberitaKODE', '$kategoriberitaNAMA', '$kategoriberitaKET')";
    
    if (mysqli_query($connection, $query)) {
        header("location:BeritaHana.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Berita</title>
  </head>
  <body>
    <?php
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
                        <h1 class="mt-4">Berita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10"></div>
                                <form method="post" class="mx-auto">
                                    <div class="form-group row">
                                        <label for="kategoriberitaKODE" class="col-sm-3 col-form-label">Kode Kategori Berita</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="kategoriberitaKODE" name="InputKategoriKode" placeholder="Kode Kategori Berita">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kategoriberitaNAMA" class="col-sm-3 col-form-label">Nama Kategori Berita</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="kategoriberitaNAMA" name="InputKategoriNama" placeholder="Inputkan Kategori Berita">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kategoriberitaKET" class="col-sm-3 col-form-label">Keterangan Kategori Berita</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="kategoriberitaKET" name="InputKategoriKet" placeholder="Keterangan Kategori Berita">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-7">
                                            <input class="btn btn-primary" type="submit" value="Simpan" name="Simpan">
                                            <input class="btn btn-primary" type="reset" value="Reset">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Optional JavaScript -->
                        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
