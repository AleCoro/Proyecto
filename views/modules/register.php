<?php
    if (isset($_POST["nuevoUsuario"]) && !empty($_POST["nuevoUsuario"])) {
        $usuario = new LoginController();
        $usuario = $usuario->ctrRegister();
    }
    include("views/partials/registerView.php");