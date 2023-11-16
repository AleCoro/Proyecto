<?php 
    require_once("../../../models/conexion.php");

    function DatosProfesorPorAreaYAsignatura($area, $asignatura, $precio)
    {
        $conexion = Conexion::conectar();
        if (isset($area) && isset($asignatura)) {
            if ($precio > 0) {
                $Where = "AND imp.precio <= $precio"; 
            }else {
                $Where = ''; 
            }
            $sql = "SELECT *, GROUP_CONCAT(asi.nombre_asignatura) AS todasAsignaturas
                    FROM usuarios as usu
                    JOIN imparte as imp ON usu.id_usuario = imp.profesor
                    JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
                    JOIN areas_academicas as are ON asi.area_academica = are.id_area
                    WHERE are.id_area LIKE '$area' AND asi.id_asignatura LIKE '$asignatura' $Where
                    GROUP BY usu.id_usuario";
            // var_dump($sql);
        }

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

    }

    if (isset($_GET["area"]) && isset($_GET["asignatura"]) && isset($_GET["precio"])) {
        $porfesores = DatosProfesorPorAreaYAsignatura($_GET["area"],$_GET["asignatura"],$_GET["precio"]);
        echo json_encode($porfesores);
    }