<?php 
    require_once("../../../models/conexion.php");

    function mostrarClases($campo,$valor){
        $conexion = Conexion::conectar();
        $sql = "SELECT asi.id_asignatura, imp.id_imparte, asi.nombre_asignatura as title,  imp.fecha_imparte as 'start', DATE_ADD(imp.fecha_imparte, INTERVAL 1 HOUR) as 'end', disponibilidad, precio
        FROM imparte as imp
        JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
        WHERE $campo like :valor";

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":valor", $valor);
        $sentencia->execute();
        $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    if ($_GET["profesor"]) {
        $clases = mostrarClases("profesor", $_GET["profesor"]);
        
        foreach ($clases as &$clase) {
            if ($clase["disponibilidad"] == 0) {
                $clase["backgroundColor"] = "#44ff00";
            }else {
                $clase["backgroundColor"] = "#ff0000";
            }

            $fecha = new DateTime($clase["start"]);
            $hoy = new DateTime();

            if ($fecha < $hoy) {
                $clase["backgroundColor"] = "#A4A4A4";
            }
        }
        // var_dump($clases);
        echo json_encode($clases);
    }