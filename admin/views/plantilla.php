<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Neptuno | MVC</title>

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


</head>
<body class="hold-transition sidebar-mini">
<?php
  if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] == 1) {
    // <!-- Site wrapper -->
    echo '<div class="wrapper">';
    // <!-- NAVEGACION -->
      include('modulos/header.php');
    // <!-- /.NAVEGACION -->

    // <!-- MENU IZQUIERDO -->
      include('modulos/menu.php');
    // <!-- /.MENU IZQUIERDO -->

    // <!-- CONTENIDO WRAPPER -->
      if (isset($_GET["ruta"])) {
        if ($_GET["ruta"]=="inicio" || 
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "about" ||
        $_GET["ruta"] == "class" ||
        $_GET["ruta"] == "team" ||
        $_GET["ruta"] == "gallery" ||
        $_GET["ruta"] == "blog" ||
        $_GET["ruta"] == "single" ||
        $_GET["ruta"] == "contact" ||
        $_GET["ruta"] == "login" ||
        $_GET["ruta"] == "register" ||
        ($_GET["ruta"] == "logout" && $_SESSION["session_usuario"] != "")) {

          include("modulos/".$_GET["ruta"].".php");
        }else {
          include("modulos/404.php");
        }
      }else {
        include("modulos/inicio.php");
      }
    // <!-- /.CONTENIDO WRAPPER -->
  }else {
    header('Location: ../inicio');
  }
    

    // <!-- FOOTER -->
      include('modulos/footer.php');
    // <!-- /.FOOTER -->
echo "</div>"
// <!-- ./Site wrapper -->
?>
</body>
</html>
