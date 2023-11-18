<?php 
    require_once("../../../models/conexion.php");

    function actualizarReserva($datos, $id)
    {

        $conexion = Conexion::conectar();
        //Extraemos los campos
        $valores = "";
        foreach ($datos as $campo => $valor) {
            $valores .= "$campo = :$campo,";
        }
        $valores = rtrim($valores, ",");

        //Hacemos la consulta
        $sql = "UPDATE reservas SET $valores WHERE id_reserva = :id";

        //La preparamos
        $sentencia = $conexion->prepare($sql);
        foreach ($datos as $campo => $valor) {
            $sentencia->bindValue(":$campo", $valor);
        }
        $sentencia->bindValue(":id", $id);

        //Y la ejecutamos
        if ($sentencia->execute()) {
            return true;
        } else {
            return false;
        }
        $sentencia = null;
    }

    if (isset($_GET["id_reserva"]) && isset($_GET["valoracion"])) {
        $datos["valoracion"] = $_GET["valoracion"];
        $result = actualizarReserva($datos, $_GET["id_reserva"]);
        echo $result;
    }