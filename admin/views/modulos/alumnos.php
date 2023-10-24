<?php

    $rolesController = new RolesController();
    $datosAlumnos = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol","3");

    $usuariosController = new ControladorUsuarios();

    foreach ($datosAlumnos as $datoAlumnos) {
        $alumnos[] = $usuariosController->ctrMostrarUsuarios("id_usuario", $datoAlumnos["usuario"]);
    }
    
    include("views/partials/alumnos.View.php");