<?php
if (isset($_POST["id_profesor"])) {
    $usuariosController = new UsuariosController();
    $profesor = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $_POST["id_profesor"]);
}else {
    header("Location: inicio");
}

  include("views/partials/profesorView.php");