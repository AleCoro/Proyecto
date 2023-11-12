<?php
require_once("conexion.php");

class ModeloUsuarios
{
    // ====================================== MOSTRAR USUARIOS ======================================

    static public function mdlMostrarUsuarios($tabla)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        // $sentencia->close();
        $sentencia = null;
    }

    // ====================================== MOSTRAR USUARIO WHERE ======================================

    static public function mdlMostrarUsuarioWhere($tabla, $campo, $valor)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
        $sentencia->bindParam(":valor", $valor, PDO::PARAM_STR);
        $sentencia->execute();
        return $sentencia->fetch();

        // $sentencia->close();
        $sentencia = null;
    }

    // ====================================== BORRAR USUARIOS ======================================

    static public function mdlBorrarUsuario($tabla, $id)
    {
        $conexion = Conexion::conectar();

        //Hacemos la consulta
        $sql = "DELETE FROM $tabla WHERE id_usuario = :id";

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

    // ====================================== ACTUALIZAR USUARIO ======================================

    public static function mdlActualizarUsuario($tabla, $datos, $id)
    {

        $conexion = Conexion::conectar();
        //Extraemos los campos
        $valores = "";
        foreach ($datos as $campo => $valor) {
            $valores .= "$campo = :$campo,";
        }
        $valores = rtrim($valores, ",");

        //Hacemos la consulta
        $sql = "UPDATE $tabla SET $valores WHERE id_usuario = :id";

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

    // ====================================== VALIDAR DATOS ======================================

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

    // ====================================== CONSULTA MULTITABLA ======================================

    static public function mdlDatosProfesor($area)
    {
        $conexion = Conexion::conectar();
        $sql = "SELECT *
        FROM usuarios as usu
        JOIN imparte as imp ON usu.id_usuario = imp.profesor
        JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
        JOIN areas_academicas as are ON asi.area_academica = are.id_area
        WHERE id_area LIKE '$area'
        GROUP BY id_usuario";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        // $sentencia->close();
        $sentencia = null;
    }
}
