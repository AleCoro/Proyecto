<?php
    if (isset($_POST["usuario"]) && !empty($_POST["usuario"])) {
        $usuario = new LoginController();
        $usuario = $usuario->ctrLogin();
    }
    include("views/partials/loginView.php");