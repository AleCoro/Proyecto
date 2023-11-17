<?php 
    require_once("../../../models/conexion.php");

    function MostrarRegistrosWhere($tabla,$campo,$valor){
            
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
        $sentencia->bindValue(":valor", $valor);
        $sentencia->execute();
        $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

    }

    if ($_GET["area"]) {
        $asignaturas = MostrarRegistrosWhere("asignaturas", "area_academica", $_GET["area"]);
        echo json_encode($asignaturas);
    }