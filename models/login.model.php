<?php 
    require_once("conexion.php");

    class LoginModel{
        // ====================================== Comprobar Exisitencia ======================================

        static public function Comprobar_Exisitencia_Registro($tabla,$columna,$registro){
            if (!empty($registro)) {
                $conexion = Conexion::conectar();
                $consulta="SELECT * FROM $tabla  WHERE $columna LIKE '$registro' ";
                $resultados=$conexion->query($consulta);
                $filas=$resultados->rowCount();
                if ($filas>0) {
                    $resultado = $resultados->fetch();
                }else {
                    $resultado=NULL;
                }
                return $resultado;
            }
        }

        // Filtrar varchar
        static public function filtrarVarchar($texto){
            if (!empty($texto)) {
                $textoValidado = trim($texto);
                $textoValidado = filter_var(stripslashes($textoValidado), FILTER_SANITIZE_STRING);
                return $textoValidado;
            }else {
                // No es texto
                return NULL;
            }
        }

        // Filtrar Correo
        static public function filtrarCorreo($correo){
            if (!empty($correo)) {
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    // No es un correo
                    return NULL;
                }else{
                    $correoValidado = trim($correo);
                    $correoValidado = filter_var(stripslashes($correoValidado), FILTER_SANITIZE_EMAIL);
                    return $correoValidado;
                }
            }else {
                // vacio
                return NULL;
            }
        }

        static public function mdlRegistrarUsuario($tabla, $datos){
            $conexion = Conexion::conectar();

            //Extraemos los campos
            $campos = implode(",",array_keys($datos));
            $valores = ":".implode(",:",array_keys($datos));

            //Hacemos la consulta
            $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";

            //La preparamos
            $sentencia=$conexion->prepare($sql);
            foreach ($datos as $campo => $valor) {
                $sentencia->bindValue(":$campo", $valor);
            }

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }

            $sentencia=null;
        }

    }