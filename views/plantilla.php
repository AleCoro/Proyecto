<?php
session_start();
?>
<!-- HEADER -->
<?php include("modules/header.php"); ?>
<?php $ruta = RutaController::ctrRuta(); ?>

<!-- CONTENIDO -->
<?php

if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] == 1) {
    echo '<script>window.location="./admin/inicio"</script>';
} else {
    if (isset($_GET["ruta"])) {
        if (
            $_GET["ruta"] == "inicio" ||
            $_GET["ruta"] == "about" ||
            $_GET["ruta"] == "class" ||
            $_GET["ruta"] == "team" ||
            $_GET["ruta"] == "gallery" ||
            $_GET["ruta"] == "profesor" ||
            $_GET["ruta"] == "blog" ||
            $_GET["ruta"] == "single" ||
            $_GET["ruta"] == "contact" ||
            $_GET["ruta"] == "postDetalle" ||
            ($_GET["ruta"] == "login" && !isset($_SESSION["session_usuario"])) ||
            ($_GET["ruta"] == "register" && !isset($_SESSION["session_usuario"])) ||
            ($_GET["ruta"] == "miPerfil" && isset($_SESSION["session_usuario"])) ||
            ($_GET["ruta"] == "logout" && isset($_SESSION["session_usuario"]))
        ) {
            include("modules/" . $_GET["ruta"] . ".php");
        } else {
            include("modules/inicio.php");
        }
    } else {
        include("modules/404.php");
    }
}
?>

<!-- FOOTER -->
<?php include("modules/footer.php"); ?>