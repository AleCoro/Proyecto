<?php

    $asignaturasController = new AsignaturasController();

    $datosAsignaturas = $asignaturasController->ctrMostrarAsignaturas("asignaturas");


    if (isset($_POST["accion"]) && $_POST["accion"] == "InsertarAsignatura") {
        $datos = array(
            "nombre_asignatura" => $_POST["add_nombre"]
        );
    
        $asignaturasController->ctrInsertar("asignaturas", $datos, "asignaturas");
        
    }

    if (isset($_POST["accion"]) && $_POST["accion"] == "EditarAsignatura") {
        $datos = array(
            "nombre_asignatura" => $_POST["edit_nombre"]
        );
    
        $id = $_POST["edit_id"];
    
        $asignaturasController->ctrActualizar("asignaturas", $datos, "asignaturas", $id);
        
    }
    
    if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarAsignatura") {
        
        // Eliminamos de la tabla imparte los registros que coincidan con la asignatura
        $asignaturasController->ctrEliminar("imparte", "asignatura", $_POST["id_asignatura"], "asignaturas");
        // Eliminamos esa asignatura
        $asignaturasController->ctrEliminar("asignaturas", "id_asignatura",$_POST["id_asignatura"],"asignaturas");
    }

    include("views/partials/asignaturas.View.php");