<?php
    if (isset($_POST["nuevoUsuario"]) && !empty($_POST["nuevoUsuario"])) {
        $usuario = new LoginController();
        $usuario = $usuario->ctrRegister();
        // var_dump($_POST);
    }

    include("views/partials/registerView.php");