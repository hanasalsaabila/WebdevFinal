<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Travel</title>
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

        .jumbotron-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table-container {
            margin-top: 20px;
        }

        .btn-container {
            margin-top: 10px;
        }
    </style>
</head>

<?php 
    include "include/config.php";
    if(isset($_POST['Pesan'])) {
        $nama = $_POST['inputnama'];
        $alamat = $_POST['inputalamat'];
        $inputtravel = $_POST['inputtravel'];
        $inputkeberangkatan = $_POST['inputkeberangkatan'];
        $inputtujuan = $_POST['inputtujuan'];
        $tanggal = $_POST['inputtanggal'];

        // Check if data already exists
        $existingData = mysqli_query($connection, "SELECT * FROM travel WHERE nama = '$nama' AND alamat = '$alamat'");
        if (mysqli_num_rows($existingData) > 0) {
            echo '<script>
                    alert("Submitted data cannot be deleted or replaced for any reason.");
                    window.location.href = "TravelHana.php";
                  </script>';
            exit; // Stop further execution
        } else {
            mysqli_query($connection, "INSERT INTO travel (id, nama, alamat, travel, keberangkatan, tujuan, tanggal) VALUES (NULL, '$nama', '$alamat', '$inputtravel', '$inputkeberangkatan', '$inputtujuan', '$tanggal')");
            echo '<script>
                    alert("Submitted data cannot be deleted or replaced for any reason.");
                    window.location.href = "TravelHana.php";
                  </script>';
            exit; // Stop further execution
        }
    }    
?>

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
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>
    <div class="container form-container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="display-4">Pemesanan Travel</h1>
            </div>
        </div>

        <form method="POST">
            <div class="form-group row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="inputnama" placeholder="Nama">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="inputalamat" placeholder="Alamat">
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="travel" class="col-sm-2 col-form-label">Pilih Travel</label>
                <div class="col-sm-10">
                    <select class="form-control" id="travel" name="inputtravel">
                        <!-- Tambahkan daftar travel yang tersedia di sini -->
                        <option value="Baraya Travel">Baraya Travel</option>
                        <option value="Cititrans">Cititrans</option>
                        <option value="Daytrans">Daytrans</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="tujuan" class="col-sm-2 col-form-label">Pilih Keberangkatan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="keberangkatan" name="inputkeberangkatan">
                        <!-- Tambahkan daftar keberangkatan yang tersedia di sini -->
                        <option value="Buahbatu">Buahbatu</option>
                        <option value="Dipatiukur">Dipatiukur</option>
                        <option value="Pasteur">Pasteur</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="tujuan" class="col-sm-2 col-form-label">Pilih Tujuan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="tujuan" name="inputtujuan">
                        <!-- Tambahkan daftar tujuan yang tersedia di sini -->
                        <option value="Bintaro">Bintaro</option>
                        <option value="Fatmawati">Fatmawati</option>
                        <option value="Grogol">Grogol</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="inputtanggal">
                </div>
            </div>

            <div class="form-group row btn-container">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" name="Pesan" class="btn btn-primary" value="Pesan">
                    <input type="submit" name="Batal" class="btn btn-secondary" value="Batal">
                </div>
            </div>
        </form>
    </div>

    <div class="container jumbotron-container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Daftar Pemesanan Travel</h1>
            </div>
        </div>
    </div>

    <div class="container table-container">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Travel</th>
                <th>Keberangkatan</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connection, "SELECT * FROM travel");
            $nomor = 1;
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $nomor . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['travel'] . "</td>";
                echo "<td>" . $row['keberangkatan'] . "</td>";
                echo "<td>" . $row['tujuan'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "</tr>";
                $nomor++;
            }
            ?>
        </tbody>
    </table>
</div>

                </main>
                <?php include "include/footer.php"; ?>
            </div>
        </div>
        <?php include "include/scriptjs.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <script type="text/javascript" src="js/bootstrap.min.js"></script>
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            </div>
        </div>
    </div>

</body>

</html>
