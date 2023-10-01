<?php
  if (isset($_GET["ruta"])) {
    $ruta = $_GET["ruta"];
  }else {
    $ruta = "inicio";
  }

  // Define un arreglo de enlaces y sus correspondientes URLs
  $nav_links = array(
    'Home' => 'inicio',
    'About' => 'about',
    'Classes' => 'class',
    'Teachers' => 'team',
    'Gallery' => 'gallery',
    'Contact' => 'contact'
  );


  include("views/partials/headerView.php");