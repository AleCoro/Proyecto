<?php

$rolesController = new RolesController();
$datosAlumnos = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "3");

$usuariosController = new ControladorUsuarios();

foreach ($datosAlumnos as $datoAlumnos) {
    $alumnos[] = $usuariosController->ctrMostrarUsuarios("id_usuario", $datoAlumnos["usuario"]);
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EditarAlumno") {
    $datos = array(
        "usuario" => $_POST["edit_usuario"],
        "nombre" => $_POST["edit_nombre"],
        "apellidos" => $_POST["edit_apellidos"],
        "direccion" => $_POST["edit_direccion"],
        "telefono" => $_POST["edit_telefono"],
        "email" => $_POST["edit_email"],
        "fecha_nacimiento" => $_POST["edit_fecha_nacimiento"]
    );

    $tabla = "usuarios";
    $redireccion = "alumnos";
    $id = $_POST["edit_id"];

    $usuariosController->ActualizarUsuario($tabla, $datos, $redireccion, $id);
    
}

include("views/partials/alumnos.View.php");
