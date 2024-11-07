<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include "include/config.php";
  $kategori = mysqli_query($connection, "select * from kategoriwisata");
  $destinasi = mysqli_query($connection, "SELECT * FROM kategoriwisata, destinasi, fotodestinasi
  WHERE kategoriwisata.kategoriKODE = destinasi.kategoriKODE
  AND destinasi.destinasiKODE = fotodestinasi.destinasiKODE");
  $fotodestinasi = mysqli_query($connection, "SELECT * FROM fotodestinasi");
  $hotel = mysqli_query($connection, "select * from hotel");
  $travel = mysqli_query($connection, "select * from travel");
  $menu_items = mysqli_query($connection, "select * from menu_items");
  $oleholeh = mysqli_query($connection, "select * from oleholeh");
  $hana = mysqli_query($connection, "select * from hana");
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hana's Final Exam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body> 
<!-- menu -->
<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hana's Final Exam</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori Wisata
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                if(mysqli_num_rows ($kategori) > 0)
                {
                    while ($row=mysqli_fetch_array ($kategori))
                    {?> <a class="dropdown-item" href="">
                        <?php echo $row["kategoriNAMA"];?></a>
                        <?php
                    }
                }
                ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hotel
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                if(mysqli_num_rows ($hotel) > 0)
                {
                    while ($row=mysqli_fetch_array ($hotel))
                    {?> <a class="dropdown-item" href="">
                        <?php echo $row["hotelNAMA"];?></a>
                        <?php
                    }
                }
                ?>
                </ul>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Travel
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                if(mysqli_num_rows ($hotel) > 0)
                {
                    while ($row=mysqli_fetch_array ($travel))
                    {?> <a class="dropdown-item" href="">
                        <?php echo $row["nama"];?></a>
                        <?php
                    }
                }
                ?>
                </ul>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<!-- akhir menu -->
 
<!-- membuat slider -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
  <div class="carousel-item active">
  <img src="images/Kepulauan-Raja-Ampat-Papua.jpg" class="d-block w-100" style="height: 700px;" alt="Gambar Tidak Ada">
    <div class="carousel-caption d-none d-md-block">
      <h5>Kepulauan Raja Ampat Papua</h5>
      <p>Kepulauan Raja Ampat adalah gugusan kepulauan yang berlokasi di barat bagian Semenanjung Kepala Burung (Vogelkoop) Pulau Papua.</p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="images/Pulau-Komodo-Kepulauan-Nusa-Tenggara.jpg" class="d-block w-100" style="height: 700px;" alt="Gambar Tidak Ada">
    <div class="carousel-caption d-none d-md-block">
      <h5>Pulau Komodo</h5>
      <p>Pulau Komodo adalah sebuah pulau yang terletak di Kepulauan Nusa Tenggara, berada di sebelah timur Pulau Sumbawa, yang dipisahkan oleh Selat Sape. Pulau Komodo dikenal sebagai habitat asli hewan komodo.</p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="images/Gunung-Bromo-Jawa-Timur-1536x864.jpg" class="d-block w-100" style="height: 700px;" alt="Gambar Tidak Ada">
    <div class="carousel-caption d-none d-md-block">
      <h5>Gunung Bromo</h5>
      <p>Gunung Bromo atau dalam bahasa Tengger dieja "Brama", juga disebut Kaldera Tengger, adalah sebuah gunung berapi aktif di Jawa Timur, Indonesia.</p>
    </div>
  </div>
</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- akhir slider -->
 
<!-- membuat kolom berita -->
<div class="container">
  <div class="row">
    <div class="col-sm-9">
    <?php
      if (mysqli_num_rows($destinasi) > 0) {
        while ($row = mysqli_fetch_array($destinasi)) {
   
      ?>
 
 <div class="d-flex mb-4" style="padding-right: 10px; margin-top: 50px;">
    <div class="flex-shrink-0">
        <img style="width: 250px; height: 100%;" src="images/<?php echo $row["fotodestinasiFILE"]?>" alt="Gambar Tidak Ada">
    </div>
    <div class="flex-grow-1 ms-3">
 
      <h5><?php echo $row ["destinasiNAMA"];?>
        <small class="text-muted">
          <i><?php echo $row ["kategoriNAMA"]?></i>
        </small>
      </h5>
      <p><?php echo substr ($row["destinasiKET"],0,250);?>....</p>
 
 
    <a href="#" class="btn btn-primary">Read More</a>
 
      </div>
 
    </div>
 
  <?php
  }
}
  ?>
      </div>
      <div class="container">
      <h1 for="search" class="col-sm-12 margin-bottom:30px;" style="margin-bottom:70px; margin-top: 30px;">Pilihan Makanan</h1>
  <div class="row">
    <?php
    if (mysqli_num_rows($menu_items) > 0) {
      while ($row = mysqli_fetch_array($menu_items)) {
    ?>
        <div class="col-md-3 mb-4">
          <div class="card">
            <img src="images/<?php echo $row["menu_image"]; ?>" alt="Gambar Tidak Ada" class="card-img-top" style="height: 100px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["menu_name"]; ?></h5>
              <p class="card-text"><?php echo substr($row["menu_info"], 0, 150); ?>....</p>
              <a href="http://localhost/webdev/RestoranHana.php" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
</div>


  </div>
</div>
 
    </div>
  </div> <!--penutup row -->
</div>  <!--penutup container-->
<!-- akhir kolom berita -->  
<!-- Carousel wrapper -->
<div
  id="carouselMultiItemExample"
  class="carousel slide carousel-dark text-center"
  data-mdb-ride="carousel"
>
  <!-- Controls -->
  <div class="d-flex justify-content-center mb-4">
    <button
      class="carousel-control-prev position-relative"
      type="button"
      data-mdb-target="#carouselMultiItemExample"
      data-mdb-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next position-relative"
      type="button"
      data-mdb-target="#carouselMultiItemExample"
      data-mdb-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Inner -->
  <div class="container">

  <h1 for="search" class="col-sm-12 margin-bottom:30px;" style="margin-bottom:70px; margin-top: 30px;">Oleh-oleh</h1>

  <div class="row">
    <?php
    if (mysqli_num_rows($oleholeh) > 0) {
      while ($row = mysqli_fetch_array($oleholeh)) {
    ?>
        <div class="col-md-6 mb-4">
          <div class="d-flex" style="padding-right: 10px;">
            <div class="flex-shrink-0">
              <img style="width: 200px; height: 200px;" src="images/<?php echo $row["olehFOTO"]; ?>" alt="Gambar Tidak Ada">
            </div>
            <div class="flex-grow-1 ms-3">
              <h5><?php echo $row["olehNAMA"]; ?>
              </h5>
              <p><?php echo substr($row["olehKET"], 0, 250); ?>....</p>
              <a href="http://localhost/phpo/webdev/oleholeh.php" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
</div>

<div class="container">

<h1 for="search" class="col-sm-12 margin-bottom:30px;" style="margin-bottom:70px; margin-top: 30px;">UAS Hana</h1>

<div class="row">
  <?php
  if (mysqli_num_rows($hana) > 0) {
    while ($row = mysqli_fetch_array($hana)) {
  ?>
      <div class="col-md-6 mb-4">
        <div class="d-flex" style="padding-right: 10px;">
          <div class="flex-grow-1 ms-3">
            <h5><?php echo $row["destinasiNAMA"]; ?>
            </h5>
            <p><?php echo substr($row["destinasiKET"], 0, 250); ?>....</p>
            <a href="http://localhost/phpo/webdev/oleholeh.php" class="btn btn-primary">Read More</a>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
</div>
</div>

  <!-- Inner -->
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <img
                src="images/Haruto on instagram.jpg"
                class="card-img-top"
                alt="Waterfall"
              />
              <div class="card-body">
                <h5 class="card-title">ASTON Priority Simatupang Hotel & Conference Center</h5>
                <p class="card-text">
                Jl. Let. Jend Jl. TB Simatupang No.Kav. 9, RT.2/RW.2, Kebagusan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="images/Haruto on instagram.jpg"
                class="card-img-top"
                alt="Sunset Over the Sea"
              />
              <div class="card-body">
                <h5 class="card-title">ASTON Priority Simatupang Hotel & Conference Center</h5>
                <p class="card-text">
                Jl. Let. Jend Jl. TB Simatupang No.Kav. 9, RT.2/RW.2, Kebagusan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
              src="images/Haruto on instagram.jpg"
                class="card-img-top"
                alt="Sunset over the Sea"
              />
              <div class="card-body">
                <h5 class="card-title">ASTON Priority Simatupang Hotel & Conference Center</h5>
                <p class="card-text">
                Jl. Let. Jend Jl. TB Simatupang No.Kav. 9, RT.2/RW.2, Kebagusan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp"
                class="card-img-top"
                alt="Fissure in Sandstone"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/185.webp"
                class="card-img-top"
                alt="Storm Clouds"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/186.webp"
                class="card-img-top"
                alt="Hot Air Balloons"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Single item -->
    <div class="carousel-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/187.webp"
                class="card-img-top"
                alt="Peaks Against the Starry Sky"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 mb-4 mb-lg-0 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/188.webp"
                class="card-img-top"
                alt="Bridge Over Water"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
 
          <div class="col-lg-4 mb-4 mb-lg-0 d-none d-lg-block">
            <div class="card">
              <img
                src="https://mdbcdn.b-cdn.net/img/new/standard/nature/189.webp"
                class="card-img-top"
                alt="Purbeck Heritage Coast"
              />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk
                  of the card's content.
                </p>
                <a href="#!" class="btn btn-primary">Button</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Inner -->
</div>
<!-- Carousel wrapper -->
 
<footer class="text-center text-white" style="background-color: #45637d;">
  <!-- Grid container -->
  <div class="container p-4">
    <!-- Section: Iframe -->
    <section class="">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
          <div class="ratio ratio-16x9">
            <iframe
              class="shadow-1-strong rounded"
              src="https://www.youtube.com/embed/vlDzYIIOYmM"
              title="YouTube video"
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Iframe -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" href="http://localhost/webdev/IndexHana.php#">Hana's Final Exam</a>
  </div>
  <!-- Copyright -->
</footer>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>