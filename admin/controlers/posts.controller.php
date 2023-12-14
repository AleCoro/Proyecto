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

        public function ctrInsertar($tabla,$datos,$redireccion)
        {
            // Validamos los datos
            // $datos = PostsController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta=PostsModel::mdlInsertar($tabla,$datos);

            return $respuesta;

            // Para insertar datos sigue esta estructura
            
            // if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            //     $datos = array(
            //         "nombre" => $_POST["nombre"],
            //         "descripcion" => $_POST["descripcion"],
            //         "precio" => $_POST["precio"]
            //     );
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";


            //     $crudController = new PostsController();
            //     $crudController->ctrInsertar($tabla,$datos,$redireccion);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id)
        {
            // Validamos los datos
            $datos = PostsController::ctrValidarDatos($datos,$redireccion);

            $respuesta=PostsModel::mdlActualizar($tabla,$datos,$id);

            // if ($respuesta) {
            //     echo "<script>
            //             alert('¡Se ha actualizado correctamente!');
            //             window.location = '$redireccion';
            //         </script>";
            // }else {
            //     echo "<script>
            //         alert('¡Error al hacer la actualizacion!');
            //         window.location = '$redireccion';
            //     </script>";
            // }


            // Para actualizar datos sigue esta estructura
            
            // if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            //     $datos = array(
            //         "nombre" => $_POST["nombre"],
            //         "descripcion" => $_POST["descripcion"],
            //         "precio" => $_POST["precio"]
            //     );
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";

            //     $id = $_POST["id_producto"];

            //     $crudController = new PostsController();
            //     $crudController->ctrActualizar($tabla,$datos,$redireccion,$id);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrEliminar($tabla, $campo_id, $id, $redireccion)
        {
            if (isset($id)) {
                $respuesta = PostsModel::mdlEliminar($tabla, $campo_id, $id);
            }


            // Para eliminar datos sigue esta estructura
            
            // if (isset($_POST["eliminar"]) && !empty($_POST["eliminar"])) {
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";

            //     $id = $_POST["eliminar"];

            //     $crudController = new PostsController();
            //     $crudController->ctrEliminar($tabla,$redireccion,$id);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrValidarDatos($datos,$redireccion)
        {
            // Validamos si en el array asociativo llega un fichero
            foreach ($datos as $campo => $valor) {
                // Validamos tipo texto
                if (is_string($valor)) {
                    $textoValidado = trim($valor);
                    $textoValidado = filter_var(stripslashes($textoValidado), FILTER_SANITIZE_STRING);
                    $datos[$campo] = $textoValidado;
                }
                
                // Validamos tipo Fichero
                if (isset($valor["tmp_name"]) && $valor["tmp_name"]!=null) {
                    //Definimo el tamaño maximo de megas
                    $tamañoMegas=2;
                    $tamañoMegas=$tamañoMegas*1048576;
                    //Sacamos el tamaño de nuestro fichero
                    $tamaño=filesize($valor["tmp_name"]);

                    if ($tamaño<$tamañoMegas) {
                        $url = "views/img/inmuebles_images/";
                        $carpeta = $datos["nombre"];
                        $directorio = $url.$carpeta;
                        $nombreFichero = $datos["nombre"];

                        $ficheroValidado = PostsModel::mdlValidarFichero($valor,$directorio,$nombreFichero);
                        if ($ficheroValidado=="") {
                            echo "<script>
                                alert('¡El tipo de fichero no es el correcto!');
                                window.location = '$redireccion';
                            </script>";

                            return;
                        }
                    }else {
                        echo "<script>
                            alert('¡El fichero es demasiado grande!');
                            window.location = '$redireccion';
                        </script>";
                    }
                    
                    $datos[$campo] = $ficheroValidado;
                }
            }
            return $datos;
        }
    }