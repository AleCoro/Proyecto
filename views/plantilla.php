<?php
  session_start();
?>
<!-- HEADER -->
<?php include("modules/header.php"); ?>
<?php $ruta=RutaController::ctrRuta(); ?>

<!-- CONTENIDO -->
<?php 

    // var_dump($_SESSION);
    if (isset($_GET["ruta"])) {
        if ($_GET["ruta"]=="inicio"||
            $_GET["ruta"]=="about"||
            $_GET["ruta"]=="class"||
            $_GET["ruta"]=="team"||
            $_GET["ruta"]=="gallery"||
            $_GET["ruta"]=="blog"||
            $_GET["ruta"]=="single"||
            $_GET["ruta"]=="contact"||
            $_GET["ruta"]=="login"||
            $_GET["ruta"]=="register"||
            ($_GET["ruta"]=="logout" && $_SESSION["session_usuario"]!="")) {

            include("modules/".$_GET["ruta"].".php");
            

        }else {
            include("modules/404.php");
            
        }
    }else {
        include("modules/inicio.php");
    }
?>

<!-- FOOTER -->
<?php include("modules/footer.php"); ?>