<?php
require_once("conexion.php");

class ReservasModel
{
    // Cargar Reservas
    public static function mdlMostrarReservas($tabla)
    {

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla");
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public static function mdlMostrarReservasWhere($tabla, $campo, $valor)
    {

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    public static function mdlMostrarReservaWhere($tabla, $campo, $valor)
    {

        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
        $sentencia->execute();
        $registros = $sentencia->fetch();
        return $registros;
    }

    public static function mdlMostrar_Ultima_Reserva($tabla)
    {
        global $conexion;
        $id = "id";
        $consulta = "SELECT * FROM $tabla Order by $id desc LIMIT 1";
        $resultados = $conexion->query($consulta);
        if ($resultados) {
            $resultado = $resultados->fetch();
            return $resultado;
        }
    }

    public static function mdlMostrar_Reservas_Ordenadas($tabla, $campo, $orden)
    {
        global $conexion;
        $consulta = "SELECT * FROM $tabla Order by $campo $orden LIMIT 1";
        $resultados = $conexion->query($consulta);
        if ($resultados) {
            $resultado = $resultados->fetch();
            return $resultado;
        }
    }

    public static function mdlInsertar($tabla, $datos)
    {

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

    public static function mdlActualizar($tabla, $datos, $id)
    {

        $conexion = Conexion::conectar();
        //Extraemos los campos
        $valores = "";
        foreach ($datos as $campo => $valor) {
            $valores .= "$campo = :$campo,";
        }
        $valores = rtrim($valores, ",");

        //Hacemos la consulta
        $sql = "UPDATE $tabla SET $valores WHERE id_area = :id";

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

    public static function mdlEliminar($tabla, $campo_id, $id)
    {

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

    public static function mdlValidarFichero($fichero, $directorio, $nombreFichero)
    {
        $ruta = "";

        list($ancho, $alto) = getimagesize($fichero["tmp_name"]);
        $nuevoAncho = 400;
        $nuevoAlto = 400;

        // SEGUN FORMATO DE imagen APLICAMOS UNAS FUNCIONES U OTRAS
        if ($fichero["type"] == "image/jpeg") {

            // CREAMOS EL DIRECTORIO DONDE GUARDAR LA imagen
            if (!file_exists($directorio)) {
                mkdir($directorio, 0755);
            }

            // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            $ruta = $directorio . "/" . $nombreFichero . ".jpeg";
            $origen = imagecreatefromjpeg($fichero["tmp_name"]);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);
        }

        if ($fichero["type"] == "image/png") {

            // CREAMOS EL DIRECTORIO DONDE GUARDAR LA imagen
            if (!file_exists($directorio)) {
                mkdir($directorio, 0755);
            }

            // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            $ruta = $directorio . "/" . $nombreFichero . ".png";
            $origen = imagecreatefrompng($fichero["tmp_name"]);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $ruta);
        }

        return $ruta;
    }

    // Cargar Paginacion Habitaciones
    public static function mdlMostrarPaginacion($tabla, $inicio, $registrosxpagina, $orden)
    {

        $consulta = "SELECT * ";
        $consulta .= "FROM $tabla ";
        $consulta .= "ORDER BY '$orden' ";
        $consulta .= "LIMIT :inicio , :fin";
        $resultados = Conexion::conectar()->prepare($consulta);
        $resultados->bindParam(':inicio', $inicio, PDO::PARAM_INT);
        $resultados->bindParam(':fin', $registrosxpagina, PDO::PARAM_INT);
        $resultados->execute();
        if ($resultados) {
            $resultado = $resultados->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return false;
        }
    }

    // Ultimas 6 reservas
    public static function mdlMostrarReservasExpiradas($campo, $valor)
    {

        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM reservas as res
        JOIN asignaturas as p ON p.id_asignatura = res.asignatura
        JOIN usuarios as prof ON prof.id_usuario = res.profesor
        WHERE res.$campo LIKE '$valor' AND res.fecha_clase < CURRENT_TIMESTAMP
        GROUP BY res.id_reserva 
        ORDER BY res.fecha_reserva DESC LIMIT 6";
        $sentencia = $conexion->prepare($sql);
        // var_dump($sentencia);
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }

    // Ultimas 6 reservas
    public static function mdlMostrarReservasSinExpirar($campo, $valor)
    {

        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM reservas as res
            JOIN asignaturas as p ON p.id_asignatura = res.asignatura
            JOIN usuarios as prof ON prof.id_usuario = res.profesor
            WHERE res.$campo LIKE '$valor' AND res.fecha_clase > CURRENT_TIMESTAMP
            GROUP BY res.id_reserva 
            ORDER BY res.fecha_reserva DESC LIMIT 4";
        $sentencia = $conexion->prepare($sql);
        // var_dump($sentencia);
        $sentencia->execute();
        $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }
}
