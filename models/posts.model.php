<?php
    require_once("conexion.php");

    class PostsModel{
        // Cargar Posts
        public static function mdlMostrarPosts($tabla){

            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla");
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        }

        public static function mdlMostrarPostsWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        }

        public static function mdlMostrarPostWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
            $sentencia->execute();
            $registros=$sentencia->fetch(PDO::FETCH_ASSOC);
            return $registros;
        }

        public static function mdlMostrar_Ultima_Post($tabla){
            $conexion = Conexion::conectar();
            $id="id";
            $consulta="SELECT * FROM $tabla Order by $id desc LIMIT 1";
            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }

        public static function mdlMostrar_Posts_Ordenadas($tabla,$campo,$orden){
            $conexion = Conexion::conectar();
            $consulta="SELECT * FROM $tabla Order by $campo $orden LIMIT 1";
            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }

        public static function mdlInsertar($tabla,$datos){
            
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
                return $conexion->lastInsertId();
            }else {
                return false;
            }
            $sentencia=null;
        }

        public static function mdlActualizar($tabla,$datos,$campo_id,$id){
            
            $conexion = Conexion::conectar();
            //Extraemos los campos
            $valores="";
            foreach ($datos as $campo => $valor) {
                $valores .= "$campo = :$campo,";
            }
            $valores = rtrim($valores, ",");

            //Hacemos la consulta
            $sql = "UPDATE $tabla SET $valores WHERE $campo_id = :id";
            
            //La preparamos
            $sentencia=$conexion->prepare($sql);
            foreach ($datos as $campo => $valor) {
                $sentencia->bindValue(":$campo", $valor);
            }
            $sentencia->bindValue(":id",$id);

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }
            $sentencia=null;

        }

        public static function mdlEliminar($tabla, $campo_id, $id){
            
            $conexion = Conexion::conectar();

            //Hacemos la consulta
            $sql = "DELETE FROM $tabla WHERE $campo_id = :id";
            // var_dump($sql);

            //La preparamos
            $sentencia=$conexion->prepare($sql);
            $sentencia->bindValue(":id",$id);

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }
            $sentencia=null;

        }

        public static function mdlMostrarPaginacion($tabla,$inicio,$registrosxpagina,$orden){
            
            $consulta="SELECT * ";
            $consulta.="FROM $tabla ";
            $consulta.="ORDER BY '$orden' "; 
            $consulta.="LIMIT :inicio , :fin";
            $resultados = Conexion::conectar()->prepare($consulta);
            $resultados->bindParam(':inicio', $inicio, PDO::PARAM_INT);
            $resultados->bindParam(':fin', $registrosxpagina, PDO::PARAM_INT);
            $resultados->execute();
            if ($resultados) {
                $resultado = $resultados->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }else {
                return false;
            }
    
        }

        static public function mdlMostrarComentarios($post){
            $conexion = Conexion::conectar();
            $sql = "SELECT *
            FROM comentarios as com
            JOIN post as p ON p.id_post = com.post
            JOIN usuarios as usu ON usu.id_usuario = com.usuario
            WHERE p.id_post LIKE '$post'
            GROUP BY id_comentario";

    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
            // $sentencia->close();
            $sentencia = null;
        }

        static public function mdlContarComentarios($post){
            $conexion = Conexion::conectar();
            $sql = "SELECT count(id_comentario) as 'totalComentarios'
            FROM comentarios as com
            JOIN post as p ON p.id_post = com.post
            JOIN usuarios as usu ON usu.id_usuario = com.usuario
            WHERE p.id_post LIKE '$post'";

    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
    
            // $sentencia->close();
            $sentencia = null;
        }

        static public function mdlContarLikes($post){
            $conexion = Conexion::conectar();
            $sql = "SELECT count(id_like) as 'totalLikes'
            FROM likes as l
            JOIN post as p ON p.id_post = l.post
            JOIN usuarios as usu ON usu.id_usuario = l.usuario
            WHERE p.id_post LIKE '$post'";

    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
    
            // $sentencia->close();
            $sentencia = null;
        }

        static public function mdlUltimosPost(){
            $conexion = Conexion::conectar();
            $sql = "SELECT *
            FROM post
            ORDER BY fecha_publicacion DESC
            LIMIT 3";

    
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
            // $sentencia->close();
            $sentencia = null;
        }

    }