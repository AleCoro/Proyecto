<?php

    $usuariosController = new ControladorUsuarios();
    $usuarios = $usuariosController->ctrMostrarUsuarios(null,null);

    include("views/partials/alumnos.View.php");