<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>KidKinder - Kindergarten Website Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewsport" />
  <meta content="Free HTML Templates" name="keywords" />
  <meta content="Free HTML Templates" name="description" />

  <!-- Favicon -->
  <link href="views/img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Flaticon Font -->
  <link href="views/lib/flaticon/font/flaticon.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="views/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
  <link href="views/lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="views/css/style.css" rel="stylesheet" />
</head>

<body>
  <!-- Navbar Start -->
  <div class="container-fluid bg-light position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
      <a href="inicio" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px">
        <i class="flaticon-043-teddy-bear"></i>
        <span class="text-primary">KidKinder</span>
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav font-weight-bold mx-auto py-0">
          <?php
          foreach ($nav_links as $text => $url) {
            $activar = ($ruta == $url) ? 'active' : '';

            echo "<a href='$url' class='nav-item nav-link $activar'>$text</a>";
          }
          ?>
        </div>
        <!-- <a href="" class="btn btn-primary px-4">Join Class</a> -->
        <?php if (isset($_SESSION["session_usuario"])) { ?>
          <!-- <a href="logout" class="btn btn-primary px-4">Logout</a> -->
          <div class="nav-item dropdown">
            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"><?= strtoupper($_SESSION["session_usuario"]); ?></a>
            <div class="dropdown-menu rounded-0 m-0">
              <?php foreach ($nombresRoles as $nombreRol) { ?>
                <form action="" method="post" name="miFormulario<?= $nombreRol["id_rol"]; ?>">
                  <button onclick="document.getElementById('miFormulario<?= $nombreRol['id_rol']; ?>').submit()" class="dropdown-item"><?= $nombreRol["nombre_rol"]; ?></button>
                  <input type="hidden" name="perfilSeleccionado" value="<?= $nombreRol["id_rol"]; ?>">
                </form>
              <?php } ?>
              <a href="logout" class="dropdown-item">Logout</a>
            </div>
          </div>
        <?php } else { ?>
          <a href="login" class="btn btn-primary px-4">Login</a>
          <!-- <a href="register" class="btn btn-primary px-4">Register</a> -->
        <?php } ?>

      </div>
    </nav>
  </div>
  <!-- Navbar End -->