<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Academia</title>

  <!-- ========================= PLUGINS DE CSS ========================= -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- ckeditor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
  <script src="ruta/a/tu/ckeditor.js"></script>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="views/plugins/jquery-fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="views/plugins/jquery-fancybox/fancybox/jquery.easing-1.4.pack.js"></script>
  <script type="text/javascript" src="views/plugins/jquery-fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <link rel="stylesheet" href="views/plugins/jquery-fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

  <!-- ========================= PLUGINS DE JS - JQUERY ========================= -->
  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="views/dist/js/demo.js"></script> -->

  <!-- DataTables -->
  <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- Cargamos nuestros scripts -->
  <script src="views/js/scripts/funciones.js"></script>

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<?php
if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] == 1) {
  // <!-- NAVEGACION -->
  include('modulos/header.php');
  // <!-- /.NAVEGACION -->

  // <!-- MENU IZQUIERDO -->
  include('modulos/menu.php');
  // <!-- /.MENU IZQUIERDO -->

  // <!-- CONTENIDO WRAPPER -->
  if (isset($_GET["ruta"])) {
    if (
      $_GET["ruta"] == "inicio" ||
      $_GET["ruta"] == "inicio" ||
      $_GET["ruta"] == "alumnos" ||
      $_GET["ruta"] == "profesores" ||
      $_GET["ruta"] == "areasAcademicas" ||
      $_GET["ruta"] == "asignaturas" ||
      $_GET["ruta"] == "blog" ||
      ($_GET["ruta"] == "logout" && $_SESSION["session_usuario"] != "")
    ) {

      include("modulos/" . $_GET["ruta"] . ".php");
    } else {
      include("modulos/404.php");
    }
  } else {
    include("modulos/inicio.php");
  }
  // <!-- /.CONTENIDO WRAPPER -->
} else {
  header('Location: ../inicio');
}


// <!-- FOOTER -->
include('modulos/footer.php');
// <!-- /.FOOTER -->
?>