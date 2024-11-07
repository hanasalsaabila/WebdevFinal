    <!-- oleholeh.php -->

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pembelian Oleh-Oleh</title>
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

if(isset($_POST['PesanOlehOleh'])) {
    $olehNAMA = $_POST['inputolehNAMA'];
    $olehKET = $_POST['inputolehKET'];
    $inputoleholeh = $_POST['inputoleholeh'];
    $inputjumlah = $_POST['inputjumlah'];
    $tanggal = $_POST['inputtanggal'];

    // Periksa apakah file foto diupload
    if(isset($_FILES['olehFOTO']) && $_FILES['olehFOTO']['error'] === UPLOAD_ERR_OK) {
        $olehFOTO = $_FILES['olehFOTO']['name'];
        $file_tmp = $_FILES["olehFOTO"]["tmp_name"];
        $ekstensifile = pathinfo($olehFOTO, PATHINFO_EXTENSION);

        // PERIKSA EKSTENSI FILE HARUS JPG ATAU JPEG
        if(in_array($ekstensifile, array("jpg", "jpeg"))) {
            move_uploaded_file($file_tmp, 'images/' . $olehFOTO);
        } else {
            echo '<script>
                    alert("File foto harus dalam format JPG atau JPEG.");
                    window.location.href = "OlehHana.php";
                  </script>';
            exit; // Stop further execution
        }
    } else {
        // Jika file foto tidak diupload
        $olehFOTO = ""; // Atur nilai default atau sesuaikan dengan kebutuhan Anda
    }

    $selectedMenuName = $_POST['inputoleholeh'];
    $menuQuery = mysqli_query($connection, "SELECT menu_id FROM menu_items WHERE menu_name = '$selectedMenuName'");
    $menuData = mysqli_fetch_assoc($menuQuery);
    $menu_id = $menuData['menu_id'];

    // Check if data already exists
    $existingData = mysqli_query($connection, "SELECT * FROM oleholeh WHERE olehNAMA = '$olehNAMA' AND olehKET = '$olehKET'");
    if (mysqli_num_rows($existingData) > 0) {
        echo '<script>
                alert("Data dengan nama dan keterangan tersebut sudah ada.");
                window.location.href = "OlehHana.php";
              </script>';
        exit; // Stop further execution
    } else {
        // Insert data into oleholeh table with menu_id as foreign key
        mysqli_query($connection, "INSERT INTO oleholeh (id, olehNAMA, olehKET, oleholeh, jumlah, tanggal, olehFOTO, menu_id) VALUES (NULL, '$olehNAMA', '$olehKET', '$inputoleholeh', '$inputjumlah', '$tanggal', '$olehFOTO', '$menu_id')");

        echo '<script>
                alert("Pembelian oleh-oleh berhasil!");
                window.location.href = "OlehHana.php";
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
                            <h1 class="mt-4"></h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active"></li>
                            </ol>
                            <div class="container form-container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="display-4">Pembelian Oleh-Oleh</h1>
                                    </div>
                                </div>

                                
                                <form method="POST" enctype="multipart/form-data">

                                    <div class="form-group row mb-3">
                                        <label for="olehNAMA" class="col-sm-2 col-form-label">Nama Oleh-Oleh</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="inputolehNAMA" placeholder="Nama Oleh-Oleh" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
    <label for="olehKET" class="col-sm-2 col-form-label">Deskripsi Oleh-Oleh</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="olehKET" name="inputolehKET" placeholder="Deskripsi Oleh-Oleh" rows="5" required></textarea>
    </div>
</div>


                                    <div class="form-group row mb-3">
        <label for="oleholeh" class="col-sm-2 col-form-label">Pilih Oleh-Oleh</label>
        <div class="col-sm-10">
            <select class="form-control select2" id="oleholeh" name="inputoleholeh" required>
            <?php
        $menuQuery = mysqli_query($connection, "SELECT menu_id, menu_name FROM menu_items");
        while ($menuRow = mysqli_fetch_array($menuQuery)) {
            echo "<option value='{$menuRow['menu_name']}'>{$menuRow['menu_name']}</option>";
        }
        ?>
            </select>
        </div>
    </div>

                                    <div class="form-group row mb-3">
                                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="jumlah" name="inputjumlah" placeholder="Jumlah" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="tanggal" name="inputtanggal" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
    <label for="olehFOTO" class="col-sm-2 col-form-label">Foto Oleh-Oleh</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="olehFOTO" name="olehFOTO" accept="images/*">
    </div>
</div>


                                    <div class="form-group row btn-container">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="submit" name="PesanOlehOleh" class="btn btn-primary" value="Pesan Oleh-Oleh">
                                            <input type="reset" name="Batal" class="btn btn-secondary" value="Batal">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="container jumbotron-container">
                                <div class="jumbotron jumbotron-fluid">
                                    <div class="container">
                                        <h1 class="display-4">Daftar Pembelian Oleh-Oleh</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="container table-container">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Oleh-Oleh</th>
                    <th>Deskripsi Oleh-Oleh</th>
                    <th>Oleh-Oleh</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Foto Oleh-Oleh</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $query = mysqli_query($connection, "SELECT * FROM oleholeh");
    $nomor = 1;
    while ($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $nomor . "</td>";
        echo "<td>" . $row['olehNAMA'] . "</td>";
        echo "<td>" . $row['olehKET'] . "</td>"; // Change from alamat to olehKET
        echo "<td>" . $row['oleholeh'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['tanggal'] . "</td>";
        echo "<td>";
        if (is_file("images/" . $row['olehFOTO'])) {
            echo "<img src='images/{$row['olehFOTO']}' alt='Foto Oleh-Oleh' style='max-width: 100px; max-height: 100px;'>";
        } else {
            echo "<img src='images/noimage.png' alt='No Image' style='max-width: 100px; max-height: 100px;'>";
        }
        echo "</td>";
        echo "</tr>";
        $nomor++;
    }
    ?>
</tbody>
        </table>
    </div>


                        </div>
                    </main>
                    <?php include "include/footer.php"; ?>
                </div>
            </div>
            <?php include "include/scriptjs.php"; ?>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#menu_id').select2(
                        {closeOnSelect: true, allowClear: true, placeholder: 'Pilih Menu'}
                    );
                });
            </script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
        </body>

    </html>
