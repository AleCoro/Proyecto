<?php

require_once("../../../controlers/roles.controller.php");
require_once("../../../models/roles.model.php");

require_once("../../../controlers/asignaturas.controller.php");
require_once("../../../models/asignaturas.model.php");

$rolesController = new RolesController();
$asignaturasController = new AsignaturasController();

if (isset($_GET["grafica"])) {
    if ($_GET["grafica"] == "grafica1") {

        $datosAlumnos = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "3");
        $totalAlumnos = count($datosAlumnos);
        $datosProfesores = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "2");
        $totalProfesores = count($datosProfesores);

        $datos["datos"][] = $totalAlumnos;
        $datos["datos"][] = $totalProfesores;

        $datos["titulo"][] = "Alumnos";
        $datos["titulo"][] = "Profesores";

        echo json_encode($datos);
    }
    if ($_GET["grafica"] == "grafica2") {
        $asignaturas = $asignaturasController->ctrReservasPorAsignaturas();

        foreach ($asignaturas as $asignatura) {
            $datos["datos"][] = intval($asignatura["num_asignaturas"]);
            $datos["titulo"][] = $asignatura["nombre_asignatura"];
        }

        echo json_encode($datos);
    }
    if ($_GET["grafica"] == "grafica3") {
        $reservas = $asignaturasController->ctrReservasPorFecha();

        foreach ($reservas as $reserva) {
            $datos["datos"][] = $reserva["TotalReservas"];
            $datos["fechas"][] = $reserva["FechaReserva"];
        }

        echo json_encode($datos);
    }
}
