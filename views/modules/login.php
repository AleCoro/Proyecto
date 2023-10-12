<?php
    if (isset($_POST["usuario"]) && !empty($_POST["usuario"])) {
        $usuario = new LoginController();
        $respuesta = $usuario->ctrLogin();
    }
    include("views/partials/loginView.php");