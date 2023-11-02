<?php 
    require_once("../../../models/conexion.php");

    function DatosProfesor($area, $asignatura)
    {
        $conexion = Conexion::conectar();
        if (isset($area) && isset($asignatura)) {
            $sql = "SELECT *, GROUP_CONCAT(asi.nombre_asignatura) AS todasAsignaturas
                    FROM usuarios as usu
                    JOIN imparte as imp ON usu.id_usuario = imp.profesor
                    JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
                    JOIN areas_academicas as are ON asi.area_academica = are.id_area
                    WHERE are.id_area LIKE '$area' AND asi.id_asignatura LIKE '$asignatura'
                    GROUP BY usu.id_usuario";
        }

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();

    }

    if (isset($_GET["area"]) && isset($_GET["asignatura"])) {
        $porfesores = DatosProfesor($_GET["area"],$_GET["asignatura"]);
        echo json_encode($porfesores);
    }