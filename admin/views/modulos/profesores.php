<?php
    $rolesController = new RolesController();
    $usuariosController = new UsuariosController();
    $asignaturasController = new AsignaturasController();

    $datosProfesores = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol","2");

    foreach ($datosProfesores as $datoProfesores) {
        $profesores[] = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $datoProfesores["usuario"]);
    }

    if (isset($_POST["accion"]) && $_POST["accion"] == "EditarProfesor") {
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
        $redireccion = "profesores";
        $id = $_POST["edit_id"];
    
        $usuariosController->ActualizarUsuario($tabla, $datos, $redireccion, $id);
        
    }

    if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarProfesor") {
        $datos["estado"] = 0;
        $usuariosController->ActualizarUsuario("usuarios",$datos,"profesores",$_POST["id_usuario"]);
    }
    
    if (isset($_POST["accion"]) && $_POST["accion"] == "ActivarProfesor") {
        $datos["estado"] = 1;
        $usuariosController->ActualizarUsuario("usuarios",$datos,"profesores",$_POST["id_usuario"]);
    }

    include("views/partials/profesores.View.php");