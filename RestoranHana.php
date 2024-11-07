<?php
include "include/config.php";
if(isset($_POST['Simpan'])) {
    $menu_id = $_POST['inputmenuid'];
    $menu_name = $_POST['inputmenuname'];
    $menu_info = $_POST['inputmenuinfo']; // Added for menu info

    $namafile = $_FILES['file']['name'];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $ekstensifile = pathinfo($namafile, PATHINFO_EXTENSION);

    // PERIKSA EKSTENSI FILE HARUS JPG ATAU jpg
    if(($ekstensifile == "jpg") or ($ekstensifile == "JPG")) {
        move_uploaded_file($file_tmp, 'images/'.$namafile);
        mysqli_query($connection, "INSERT INTO menu_items (menu_id, menu_name, menu_info, menu_image) VALUES ('$menu_id', '$menu_name', '$menu_info', '$namafile')"); // Updated for menu_info
        header("location:RestoranHana.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu</title>
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
                        <h1 class="mt-4">Restaurant Menu</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <!-- Form to Add Menu Item -->
                        <div class="container form-container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="display-4">Add Menu Item</h1>
                                </div>
                            </div>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group row mb-3">
                                    <label for="menu_id" class="col-sm-2 col-form-label">Menu ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="menu_id" name="inputmenuid" placeholder="Menu ID" maxlength="4">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="menu_name" class="col-sm-2 col-form-label">Menu Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="menu_name" name="inputmenuname" placeholder="Menu Name">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="menu_info" class="col-sm-2 col-form-label">Menu Info</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="menu_info" name="inputmenuinfo" placeholder="Menu Info"></textarea>
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
                                        <input type="submit" name="Simpan" class="btn btn-primary" value="Add Menu">
                                        <input type="reset" class="btn btn-secondary" value="Reset">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Display Menu Items -->
                        <div class="container table-container">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Menu ID</th>
                                        <th>Menu Name</th>
                                        <th>Menu Info</th>
                                        <th>Menu Image</th>
                                        <th colspan="2" style="text-align: center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    $query = mysqli_query($connection, "SELECT * FROM menu_items");
                                    $nomor = 1;
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <tr>
                                            <td><?php echo $nomor;?></td>
                                            <td><?php echo $row['menu_id'];?></td>
                                            <td><?php echo $row['menu_name'];?></td>
                                            <td><?php echo $row['menu_info'];?></td> <!-- Added for menu_info -->
                                            <td>
                                                <?php if(is_file("images/".$row['menu_image'])) { ?>
                                                    <img src="images/<?php echo $row['menu_image']?>" class="menu-image">
                                                <?php } else {
                                                    echo "<img src='images/noimage.png' class='menu-image'>";
                                                } ?>
                                            </td>
                                            <td width="5px">
                                                <a href="EditRestoran.php?ubah=<?php echo $row["menu_id"]?>" class="btn btn-success btn-sm" title="Edit">
                                                    Edit
                                                </a>
                                            </td>
                                            <td width="5px">
                                                <a href="DeleteRestoran.php?hapus=<?php echo $row["menu_id"]?>" class="btn btn-danger btn-sm" title="Delete">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $nomor = $nomor + 1;?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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
