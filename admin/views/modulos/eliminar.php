<?php
    // var_dump($_POST["foto"]);

    if ($_POST["id"]!="") {
        $usuario = new ControladorUsuarios();
        $usuarios = $usuario->ctrBorrarUsuario($_POST["id"],$_POST["usuario"],$_POST["foto"]);
    }