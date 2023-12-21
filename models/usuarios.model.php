<?php
require_once("conexion.php");

class ModeloUsuarios
{
    // ====================================== MOSTRAR USUARIOS ======================================

    static public function mdlMostrarUsuarios($tabla){
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        // $sentencia->close();
        $sentencia = null;
    }

    // ====================================== MOSTRAR USUARIO WHERE ======================================

    static public function mdlMostrarUsuarioWhere($tabla, $campo, $valor){
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
        $sentencia->bindParam(":valor", $valor, PDO::PARAM_STR);
        $sentencia->execute();
        return $sentencia->fetch();

        // $sentencia->close();
        $sentencia = null;
    }

    // ====================================== BORRAR USUARIOS ======================================

    static public function mdlBorrarUsuario($tabla, $id){
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

    public static function mdlActualizarUsuario($tabla, $datos, $id){

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

    // ====================================== CONSULTA MULTITABLA ======================================

    static public function mdlDatosProfesorPorArea($area){
        $conexion = Conexion::conectar();
        if ($area) {
            $sql = "SELECT *
                    FROM usuarios as usu
                    JOIN imparte as imp ON usu.id_usuario = imp.profesor
                    JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
                    JOIN areas_academicas as are ON asi.area_academica = are.id_area
                    WHERE id_area LIKE '$area' && usu.estado like 1 AND imp.fecha_imparte > NOW()";
        } else {
            $sql = "SELECT *
                    FROM usuarios as usu
                    JOIN imparte as imp ON usu.id_usuario = imp.profesor
                    JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
                    JOIN areas_academicas as are ON asi.area_academica = are.id_area
                    WHERE  usu.estado like 1 AND imp.fecha_imparte > NOW()";
        }


        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
    }

    // ====================================== CONSULTA DATOS PROFESOR ======================================

    static public function mdlDatosProfesor($profesor){
        $conexion = Conexion::conectar();
        $sql = "SELECT *, GROUP_CONCAT(asi.nombre_asignatura) AS todasAsignaturas
                FROM usuarios as usu
                JOIN imparte as imp ON usu.id_usuario = imp.profesor
                JOIN asignaturas as asi ON imp.asignatura = asi.id_asignatura
                JOIN areas_academicas as are ON asi.area_academica = are.id_area
                WHERE usu.id_usuario LIKE '$profesor'
                GROUP BY usu.id_usuario";


        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
    }

    // ====================================== CONSULTA DATOS ALUMNO ======================================

    static public function mdlDatosAlumno($alumno){
        $conexion = Conexion::conectar();
        $sql = "SELECT *, GROUP_CONCAT(asi.nombre_asignatura) AS todasAsignaturas
        FROM usuarios as usu
        JOIN reservas as res ON usu.id_usuario = res.alumno
        JOIN asignaturas as asi ON res.asignatura = asi.id_asignatura
        JOIN areas_academicas as are ON asi.area_academica = are.id_area
        WHERE res.alumno LIKE '$alumno'
        GROUP BY usu.id_usuario";


        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
    }

    // ====================================== CONSULTA DATOS PROFESORES MEJOR VALORADOS ======================================

    static public function mdlProfesorMejorValorados(){
        $conexion = Conexion::conectar();
        $sql = "SELECT *, ROUND(AVG(res.valoracion), 2) as ValoracionMedia
        FROM usuarios as usu
        JOIN reservas as res ON usu.id_usuario = res.profesor
        WHERE res.valoracion > 0
        GROUP BY usu.id_usuario
        ORDER BY ValoracionMedia DESC
        LIMIT 4";


        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
    }
}
