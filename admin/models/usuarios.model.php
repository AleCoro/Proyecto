<?php 
    require_once("conexion.php");

    class ModeloUsuarios{
        // ====================================== MOSTRAR USUARIOS ======================================

        static public function mdlMostrarUsuarios($tabla, $campo, $valor){
            if ($campo !== null && $valor !== null) {
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
                $sentencia->bindParam(":valor", $valor, PDO::PARAM_STR);
                $sentencia->execute();
                return $sentencia->fetch();
            }else {
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("SELECT * FROM $tabla");
                $sentencia->execute();
                return $sentencia->fetchAll();
            }

            // $sentencia->close();
            $sentencia=null;
        }

        // ====================================== ALTA USUARIOS ======================================

        static public function mdlIngresarUsuario($tabla, $datos){
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");

            $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            if ($sentencia->execute()) {
                return "SI";
            }else {
                return "Error";
            }

            // $sentencia->close();
            $sentencia=null;
        }

        // ====================================== Editar USUARIOS ======================================

        static public function mdlEditarUsuario($tabla, $datos){
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

            $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            if ($sentencia->execute()) {
                return "SI";
            }else {
                return "Error";
            }

            // $sentencia->close();
            $sentencia=null;
        }

        // ====================================== ACTIVAR USUARIOS ======================================

        static public function mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2){
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("UPDATE $tabla SET $campo1 = :valor1 WHERE $campo2 = :valor2");

            $sentencia->bindParam(":valor1", $valor1, PDO::PARAM_STR);
            $sentencia->bindParam(":valor2", $valor2, PDO::PARAM_INT);
           
            if ($sentencia->execute()) {
                return "SI";
            }else {
                return "Error";
            }

            // $sentencia->close();
            $sentencia=null;
        }

        // ====================================== BORRAR USUARIOS ======================================

        static public function mdlBorrarUsuario($tabla, $datos){
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("DELETE FROM $tabla WHERE id = :id");
            $sentencia -> bindParam(":id", $datos, PDO::PARAM_INT);
            if ($sentencia -> execute()) {
                return "SI";
            }else {
                "Error";
            }

            // $sentencia -> close();
            $sentencia = null;
        }
    }