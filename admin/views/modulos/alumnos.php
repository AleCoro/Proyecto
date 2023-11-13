<?php

$rolesController = new RolesController();
$usuariosController = new UsuariosController();

$datosAlumnos = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "3");
// var_dump($datosAlumnos);

foreach ($datosAlumnos as $datoAlumnos) {
    $alumnos[] = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $datoAlumnos["usuario"]);
}
// var_dump($alumnos);
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

if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarAlumno") {
    $datos["estado"] = 0;
    $usuariosController->ActualizarUsuario("usuarios",$datos,"alumnos",$_POST["id_usuario"]);
}

if (isset($_POST["accion"]) && $_POST["accion"] == "ActivarAlumno") {
    $datos["estado"] = 1;
    $usuariosController->ActualizarUsuario("usuarios",$datos,"alumnos",$_POST["id_usuario"]);
}

include("views/partials/alumnos.View.php");
