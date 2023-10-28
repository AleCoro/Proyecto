<?php
    Class AreasAcademicasController{
        // Cargar AreasAcademicas
        public function ctrMostrarAreasAcademicas($tabla){

            $respuesta=AreasAcademicasModel::mdlMostrarAreasAcademicas($tabla);

            return $respuesta;
        }

        public function ctrMostrarAreasAcademicasWhere($tabla,$campo,$valor){
            $tabla="";
            $respuesta=AreasAcademicasModel::mdlMostrarAreasAcademicasWhere($tabla,$campo,$valor);

            return $respuesta;
        }

        public function ctrMostrarAsignaturaWhere($tabla,$campo,$valor){
            $tabla="";
            $respuesta=AreasAcademicasModel::mdlMostrarAsignaturaWhere($tabla,$campo,$valor);

            return $respuesta;
        }

        public function mdlMostrar_Ultima_Asignatura(){
            $tabla="";
            $respuesta=AreasAcademicasModel::mdlMostrar_Ultima_Asignatura($tabla);

            return $respuesta;
        }

        public function ctrInsertar($tabla,$datos,$redireccion)
        {
            // Validamos los datos
            $datos = AreasAcademicasController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta=AreasAcademicasModel::mdlInsertar($tabla,$datos);

            if ($respuesta) {
                echo "<script>
                        alert('¡Se ha dado de alta correctamente!');
                        window.location = '$redireccion';
                    </script>";
            }else {
                echo "<script>
                    alert('¡Error al dar de alta!');
                    window.location = '$redireccion';
                </script>";
            }


            // Para insertar datos sigue esta estructura
            
            // if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
            //     $datos = array(
            //         "nombre" => $_POST["nombre"],
            //         "descripcion" => $_POST["descripcion"],
            //         "precio" => $_POST["precio"]
            //     );
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";


            //     $crudController = new AreasAcademicasController();
            //     $crudController->ctrInsertar($tabla,$datos,$redireccion);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id)
        {
            // Validamos los datos
            $datos = AreasAcademicasController::ctrValidarDatos($datos,$redireccion);

            $respuesta=AreasAcademicasModel::mdlActualizar($tabla,$datos,$id);

            if ($respuesta) {
                echo "<script>
                        alert('¡Se ha actualizado correctamente!');
                        window.location = '$redireccion';
                    </script>";
            }else {
                echo "<script>
                    alert('¡Error al hacer la actualizacion!');
                    window.location = '$redireccion';
                </script>";
            }


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

            //     $crudController = new AreasAcademicasController();
            //     $crudController->ctrActualizar($tabla,$datos,$redireccion,$id);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrEliminar($tabla, $campo_id, $id, $redireccion)
        {
            if (isset($id)) {
                $respuesta = AreasAcademicasModel::mdlEliminar($tabla, $campo_id, $id);

                if ($respuesta) {
                    echo "<script>
                            alert('¡Se ha eliminado correctamente!');
                            window.location = '$redireccion';
                        </script>";
                } else {
                    echo "<script>
                        alert('¡Error al eliminar!');
                        window.location = '$redireccion';
                    </script>";
                }
            }


            // Para eliminar datos sigue esta estructura
            
            // if (isset($_POST["eliminar"]) && !empty($_POST["eliminar"])) {
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";

            //     $id = $_POST["eliminar"];

            //     $crudController = new AreasAcademicasController();
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

                        $ficheroValidado = AreasAcademicasModel::mdlValidarFichero($valor,$directorio,$nombreFichero);
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