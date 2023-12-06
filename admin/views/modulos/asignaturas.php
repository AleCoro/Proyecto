<?php

$asignaturasController = new AsignaturasController();
$areasAcademicasController = new AreasAcademicasController();

$datosAsignaturas = $asignaturasController->ctrMostrarAsignaturas("asignaturas");

// &$dato se utilizar para guardar los cambios en la variable $datosAsignaturas sin "&" no se veria reflejado en la variable principal
foreach ($datosAsignaturas as &$dato) {

    $area = $areasAcademicasController->ctrMostrarAreaAcademicaWhere("areas_academicas", "id_area", $dato["area_academica"]);
    $dato["nombre_area"] = $area["nombre_area"];
}
unset($dato);


if (isset($_POST["accion"]) && $_POST["accion"] == "InsertarAsignatura") {
    $datos = array(
        "nombre_asignatura" => $_POST["add_nombre"],
        "area_academica" => $_POST["add_area"]
    );

    $asignaturasController->ctrInsertar("asignaturas", $datos, "asignaturas");

    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Asignatura Creada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'asignaturas';
        }
        showSuccessAlert();
    </script>";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EditarAsignatura") {
    $datos = array(
        "nombre_asignatura" => $_POST["edit_nombre"],
        "area_academica" => $_POST["edit_area"]
    );

    $id = $_POST["edit_id"];

    $asignaturasController->ctrActualizar("asignaturas", $datos, "asignaturas", $id);

    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Asignatura Acturalizada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'asignaturas';
        }
        showSuccessAlert();
    </script>";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarAsignatura") {

    // Eliminamos de la tabla imparte los registros que coincidan con la asignatura
    $asignaturasController->ctrEliminar("imparte", "asignatura", $_POST["id_asignatura"], "asignaturas");
    // Eliminamos esa asignatura
    $asignaturasController->ctrEliminar("asignaturas", "id_asignatura", $_POST["id_asignatura"], "asignaturas");


    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Asignatura Eliminada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'asignaturas';
        }
        showSuccessAlert();
    </script>";
}

$areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

include("views/partials/asignaturas.View.php");
