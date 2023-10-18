<?php
    // var_dump($_POST);
    $usuario = new ControladorUsuarios();
    if ($_POST["estado"]==0) {
        $estado = 1;
    }else {
        $estado = 0;
    }
    $usuarios = $usuario->ctrActivarUsuario($estado, $_POST["id"]);