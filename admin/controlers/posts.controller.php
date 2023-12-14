<?php
    Class PostsController{
        // Cargar Posts
        public function ctrMostrarPosts($tabla){
            $respuesta=PostsModel::mdlMostrarPosts($tabla);
            return $respuesta;
        }

        public function ctrMostrarPostsWhere($tabla,$campo,$valor){
            $respuesta=PostsModel::mdlMostrarPostsWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function ctrMostrarPostWhere($tabla,$campo,$valor){
            $respuesta=PostsModel::mdlMostrarPostWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function mdlMostrar_Ultima_Post($tabla){
            $respuesta=PostsModel::mdlMostrar_Ultima_Post($tabla);
            return $respuesta;
        }

        public function ctrInsertar($tabla,$datos,$redireccion){
            // Validamos los datos
            $datos = PostsController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta=PostsModel::mdlInsertar($tabla,$datos);
            return $respuesta;
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id){
            // Validamos los datos
            $datos = PostsController::ctrValidarDatos($datos,$redireccion);

            $respuesta=PostsModel::mdlActualizar($tabla,$datos,$id);
            return $respuesta;
        }

        public function ctrEliminar($tabla, $campo_id, $id){
            if (isset($id)) {
                $respuesta = PostsModel::mdlEliminar($tabla, $campo_id, $id);
                return $respuesta;
            }
        }

        public function ctrValidarDatos($datos)
        {
            // Validamos si en el array asociativo llega un fichero
            foreach ($datos as $campo => $valor) {
                // Validamos tipo texto
                if (is_string($valor)) {
                    $textoValidado = trim($valor);
                    $textoValidado = filter_var(stripslashes($textoValidado), FILTER_SANITIZE_STRING);
                    $datos[$campo] = $textoValidado;
                }
            }
            return $datos;
        }
    }