<?php
  $ruta = $_GET["ruta"];

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