<?php
require_once("conexion.php");

class AsignaturasModel
{
    // Cargar Asignaturas
    public static function mdlMostrarAsignaturas($tabla){

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla");
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public static function mdlMostrarAsignaturasWhere($tabla, $campo, $valor){

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public static function mdlMostrarAsignaturaWhere($tabla, $campo, $valor){

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
        $sentencia->execute();
        $registros = $sentencia->fetch();
        return $registros;
    }

    public static function mdlMostrar_Ultima_Asignatura($tabla){
        $conexion = Conexion::conectar();
        $consulta = "SELECT * FROM $tabla Order by 'id_asignaturas' desc LIMIT 1";
        $resultados = $conexion->query($consulta);
        if ($resultados) {
            $resultado = $resultados->fetch();
            return $resultado;
        }
    }

    public static function mdlMostrar_Asignaturas_Ordenadas($tabla, $campo, $orden){
        $conexion = Conexion::conectar();
        $consulta = "SELECT * FROM $tabla Order by $campo $orden LIMIT 1";
        $resultados = $conexion->query($consulta);
        if ($resultados) {
            $resultado = $resultados->fetch();
            return $resultado;
        }
    }

    public static function mdlInsertar($tabla, $datos){

        $conexion = Conexion::conectar();
        //Extraemos los campos
        $campos = implode(",", array_keys($datos));
        $valores = ":" . implode(",:", array_keys($datos));

        //Hacemos la consulta
        $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";

        //La preparamos
        $sentencia = $conexion->prepare($sql);
        foreach ($datos as $campo => $valor) {
            $sentencia->bindValue(":$campo", $valor);
        }

        //Y la ejecutamos
        if ($sentencia->execute()) {
            return $conexion->lastInsertId();
        } else {
            return false;
        }
        $sentencia = null;
    }

    public static function mdlActualizar($tabla, $datos, $id){

        $conexion = Conexion::conectar();
        //Extraemos los campos
        $valores = "";
        foreach ($datos as $campo => $valor) {
            $valores .= "$campo = :$campo,";
        }
        $valores = rtrim($valores, ",");

        //Hacemos la consulta
        $sql = "UPDATE $tabla SET $valores WHERE id_asignatura = :id";

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

    public static function mdlEliminar($tabla, $campo_id, $id){

        $conexion = Conexion::conectar();

        //Hacemos la consulta
        $sql = "DELETE FROM $tabla WHERE $campo_id = :id";
        // var_dump($sql);

        //La preparamos
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":id", $id);

        //Y la ejecutamos
        if ($sentencia->execute()) {
            return true;
        } else {
            return false;
        }
        $sentencia = null;
    }

    public static function mdlReservasPorAsignaturas(){
        $conexion = Conexion::conectar();

        $consulta = "SELECT nombre_asignatura, COUNT(id_asignatura) AS 'num_asignaturas'
        FROM asignaturas AS a
        INNER JOIN reservas AS r ON a.id_asignatura = r.asignatura
        GROUP BY nombre_asignatura";

        $resultados = $conexion->query($consulta);
        
        if ($resultados) {
            $resultado = $resultados->fetchAll();
            return $resultado;
        }
    }

    public static function mdlReservasPorFecha(){
        $conexion = Conexion::conectar();

        $consulta = "SELECT COUNT(id_reserva) AS TotalReservas, DATE_FORMAT(fecha_reserva, '%d/%m/%Y') AS 'FechaReserva'
        FROM reservas
        GROUP BY FechaReserva
        ORDER BY fecha_reserva ASC;";

        $resultados = $conexion->query($consulta);
        
        if ($resultados) {
            $resultado = $resultados->fetchAll();
            return $resultado;
        }
    }
}
