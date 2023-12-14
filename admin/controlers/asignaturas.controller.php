<?php
    Class AsignaturasController{
        // Cargar Asignaturas
        public function ctrMostrarAsignaturas($tabla){

            $respuesta=AsignaturasModel::mdlMostrarAsignaturas($tabla);

            return $respuesta;
        }

        public function ctrMostrarAsignaturasWhere($tabla,$campo,$valor){
            
            $respuesta=AsignaturasModel::mdlMostrarAsignaturasWhere($tabla,$campo,$valor);

            return $respuesta;
        }

        public function ctrMostrarAsignaturaWhere($tabla,$campo,$valor){
            $respuesta=AsignaturasModel::mdlMostrarAsignaturaWhere($tabla,$campo,$valor);

            return $respuesta;
        }

        public function ctrMostrar_Ultima_Asignatura($tabla){
            $respuesta=AsignaturasModel::mdlMostrar_Ultima_Asignatura($tabla);

            return $respuesta;
        }

        public function ctrInsertar($tabla,$datos,$redireccion)
        {
            // Validamos los datos
            $datos = AsignaturasController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta=AsignaturasModel::mdlInsertar($tabla,$datos);
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


            //     $crudController = new AsignaturasController();
            //     $crudController->ctrInsertar($tabla,$datos,$redireccion);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id)
        {
            // Validamos los datos
            $datos = AsignaturasController::ctrValidarDatos($datos,$redireccion);

            $respuesta=AsignaturasModel::mdlActualizar($tabla,$datos,$id);


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

            //     $crudController = new AsignaturasController();
            //     $crudController->ctrActualizar($tabla,$datos,$redireccion,$id);
            //     // var_dump($inmueble);
            //   }
            
        }

        public function ctrEliminar($tabla, $campo_id, $id, $redireccion)
        {
            if (isset($id)) {
                $respuesta = AsignaturasModel::mdlEliminar($tabla, $campo_id, $id);
            }


            // Para eliminar datos sigue esta estructura
            
            // if (isset($_POST["eliminar"]) && !empty($_POST["eliminar"])) {
    
            //     $tabla = "producto";
            //     $redireccion = "inicio";

            //     $id = $_POST["eliminar"];

            //     $crudController = new AsignaturasController();
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

                        $ficheroValidado = AsignaturasModel::mdlValidarFichero($valor,$directorio,$nombreFichero);
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

        public function ctrReservasPorAsignaturas(){
                        
            $respuesta=AsignaturasModel::mdlReservasPorAsignaturas();

            return $respuesta;
        }

        public function ctrReservasPorFecha(){
            $respuesta=AsignaturasModel::mdlReservasPorFecha();

            return $respuesta;
        }
    }