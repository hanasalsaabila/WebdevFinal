<?php
include "include/config.php";

if (isset($_GET['ubah'])) {
    $menu_idToUpdate = $_GET['ubah'];
    $result = mysqli_query($connection, "SELECT * FROM menu_items WHERE menu_id = '$menu_idToUpdate'");
    $data = mysqli_fetch_array($result);
}

if (isset($_POST['Update'])) {
    $menu_id = $_POST['inputmenuid'];
    $menu_name = $_POST['inputmenuname'];
    $menu_price = $_POST['inputmenuprice'];

    // Check if a new file is uploaded
    if ($_FILES['file']['name'] != '') {
        $namafile = $_FILES['file']['name'];
        $file_tmp = $_FILES["file"]["tmp_name"];

        $ekstensifile = pathinfo($namafile, PATHINFO_EXTENSION);

        // PERIKSA EKSTEN FILE HARUS JPG ATAU jpg
        if (($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
            move_uploaded_file($file_tmp, 'images/' . $namafile);
            $updateQuery = "UPDATE menu_items SET menu_name = '$menu_name', menu_price = '$menu_price', menu_image = '$namafile' WHERE menu_id = '$menu_id'";
        }
    } else {
        // If no new file is uploaded, update only the other fields
        $updateQuery = "UPDATE menu_items SET menu_name = '$menu_name', menu_price = '$menu_price' WHERE menu_id = '$menu_id'";
    }

    mysqli_query($connection, $updateQuery);
    header("location:RestoranHana.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Menu Item</title>
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

        .menu-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
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
                        <h1 class="mt-4">Restaurant Menu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <!-- Form to Edit Menu Item -->
                        <div class="container form-container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="display-4">Edit Restaurant Menu Item</h1>
                                </div>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
                                <!-- Populate the form fields with existing data -->
                                <div class="form-group row mb-3">
                                    <label for="menu_id" class="col-sm-2 col-form-label">Menu ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="menu_id" name="inputmenuid" placeholder="Menu ID" maxlength="4" value="<?php echo $data['menu_id']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="menu_name" class="col-sm-2 col-form-label">Menu Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="menu_name" name="inputmenuname" placeholder="Menu Name" value="<?php echo $data['menu_name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="menu_price" class="col-sm-2 col-form-label">Menu Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="menu_price" name="inputmenuprice" placeholder="Menu Price" value="<?php echo $data['menu_price']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="file" class="col-sm-2 col-form-label">Menu Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="file" name="file">
                                        <p class="help-block">This field is used to upload an image</p>
                                    </div>
                                </div>

                                <div class="form-group row btn-container">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <input type="submit" name="Update" class="btn btn-primary" value="Update">
                                        <a href="RestoranHana.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
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
