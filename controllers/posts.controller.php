<?php
class PostsController
{
    // Cargar Posts
    public function ctrMostrarPosts($tabla){
        $respuesta = PostsModel::mdlMostrarPosts($tabla);
        return $respuesta;
    }

    public function ctrMostrarPostsWhere($tabla, $campo, $valor){
        $respuesta = PostsModel::mdlMostrarPostsWhere($tabla, $campo, $valor);
        return $respuesta;
    }

    public function ctrMostrarPostWhere($tabla, $campo, $valor){
        $respuesta = PostsModel::mdlMostrarPostWhere($tabla, $campo, $valor);
        return $respuesta;
    }

    public function mdlMostrar_Ultima_Post($tabla){
        $respuesta = PostsModel::mdlMostrar_Ultima_Post($tabla);
        return $respuesta;
    }

    public function ctrInsertar($tabla, $datos){
        //Insertamos los datos si todo ha salido bien
        $respuesta = PostsModel::mdlInsertar($tabla, $datos);
        return $respuesta;
    }

    public function ctrActualizar($tabla, $datos, $campo_id, $id){
        // Validamos los datos
        $datos = PostsController::ctrValidarDatos($datos);

        $respuesta = PostsModel::mdlActualizar($tabla, $datos, $campo_id, $id);
        return $respuesta;
    }

    public function ctrEliminar($tabla, $campo_id, $id){
        if (isset($id)) {
            $respuesta = PostsModel::mdlEliminar($tabla, $campo_id, $id);
            return $respuesta;
        }
    }

    public function ctrValidarDatos($datos){
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

    // Cargar Paginacion
    public function ctrMostrarPaginacion($tabla, $pagina, $registrosxpagina){
        $orden = "ASC";

        if ($pagina == 1) {
            $inicio = 0;
        } else {
            $inicio = ($pagina * $registrosxpagina) - $registrosxpagina;
        }

        $respuesta = PostsModel::mdlMostrarPaginacion($tabla, $inicio, $registrosxpagina, $orden);
        return $respuesta;
    }

    //Mostrar comentarios
    public function ctrMostrarComentarios($post){
        $respuesta = PostsModel::mdlMostrarComentarios($post);
        return $respuesta;
    }

    //Contar comentarios
    public function ctrContarComentarios($post){
        $respuesta = PostsModel::mdlContarComentarios($post);
        return $respuesta;
    }

    //Contar likes
    public function ctrContarLikes($post){
        $respuesta = PostsModel::mdlContarLikes($post);
        return $respuesta;
    }

    //Ultimos Posts
    public function ctrUltimosPost(){
        $respuesta = PostsModel::mdlUltimosPost();
        return $respuesta;
    }

    public function formatearFecha($fechaOriginal){
        $datetime = new DateTime($fechaOriginal);
        return $datetime->format('d/m/Y H:i');
    }
}
