<?php
if (isset($_GET["ruta"])) {
    $ruta = $_GET["ruta"];
} else {
    $ruta = "inicio";
}

if (isset($_SESSION["id_usuario"])) {
    $rolesController = new RolesController();
    $roles = $rolesController->ctrMostrarRegistrosWhere("es_un", "usuario", $_SESSION["id_usuario"]);

    // Extrae los valores de "id_es" en un nuevo array
    if (count($roles) > 1) {
        $ids = array_column($roles, 'id_es');

        // Convierte el array en una cadena de valores separados por comas
        $cadenaIds = implode(', ', $ids);
    } else {
        $cadenaIds = $roles[0]["rol"];
    }

    $nombresRoles = $rolesController->ctrMostrarRegistrosWhereIn("roles", "id_rol", $cadenaIds);

    if (isset($_POST["perfilSeleccionado"])) {
        $_SESSION["perfilSeleccionado"] = $_POST["perfilSeleccionado"];
        header('Location: inicio');
    }
}

include("views/partials/header.View.php");
