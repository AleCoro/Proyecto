<?php
    if (isset($_POST["editarUsuario"]) && !empty($_POST["editarUsuario"])) {
        $usuario = new ControladorUsuarios();
        $usuario = $usuario->ctrMostrarUsuarios("usuario",$_POST["editarUsuario"]);
    }else {
        $usuario = new ControladorUsuarios();
        $usuario = $usuario->ctrMostrarUsuarios("usuario",$_POST["usuarioActual"]);
    }
   
    include("views/partials/editar.View.php");