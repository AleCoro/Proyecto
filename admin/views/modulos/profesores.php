<?php
    $rolesController = new RolesController();
    $datosProfesores = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol","2");

    $usuariosController = new ControladorUsuarios();

    foreach ($datosProfesores as $datoProfesores) {
        $profesores[] = $usuariosController->ctrMostrarUsuarios("id_usuario", $datoProfesores["usuario"]);
    }
    include("views/partials/profesores.View.php");