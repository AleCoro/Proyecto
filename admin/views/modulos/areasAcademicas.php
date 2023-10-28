<?php
    $areasAcademicasController = new AreasAcademicasController();
    $asignaturasController = new AsignaturasController();

    $datosAreasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");


    if (isset($_POST["accion"]) && $_POST["accion"] == "InsertarArea") {
        $datos = array(
            "nombre_area" => $_POST["add_nombre"],
            "descripcion_area" => $_POST["add_descripcion"]
        );
    
        $areasAcademicasController->ctrInsertar("areas_academicas", $datos, "areasAcademicas");
        
    }

    if (isset($_POST["accion"]) && $_POST["accion"] == "EditarArea") {
        $datos = array(
            "nombre_area" => $_POST["edit_nombre"],
            "descripcion_area" => $_POST["edit_descripcion"]
        );
    
        $id = $_POST["edit_id"];
    
        $areasAcademicasController->ctrActualizar("areas_academicas", $datos, "areasAcademicas", $id);
        
    }
    
    if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarArea") {
        // Buscamos las asignaturas de ese area
        $asignaturasPorArea = $asignaturasController->ctrMostrarAsignaturasWhere("asignaturas", "area_academica", $_POST["id_area"]);
        // Recorremos las asignaturas
        foreach ($asignaturasPorArea as $asignatura) {
            // borramos de la tabla imparte los registros que coincidan con la asignatura
            $asignaturasController->ctrEliminar("imparte", "asignatura", $asignatura["id_asignatura"], "areasAcademicas");
        }
        // Eliminamos esa asignatura
        $asignaturasController->ctrEliminar("asignaturas", "area_academica",$_POST["id_area"],"areasAcademicas");
        // Eliminamos el areaAcademica
        $areasAcademicasController->ctrEliminar("areas_academicas", "id_area", $_POST["id_area"], "areasAcademicas");
    }



    include("views/partials/areasAcademicas.View.php");