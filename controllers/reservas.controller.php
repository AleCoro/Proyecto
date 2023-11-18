<?php
class ReservasController
{
    // Cargar Reservas
    public function ctrMostrarReservas($tabla)
    {

        $respuesta = ReservasModel::mdlMostrarReservas($tabla);

        return $respuesta;
    }

    public function ctrMostrarReservasWhere($tabla, $campo, $valor)
    {
        // $tabla = "";
        $respuesta = ReservasModel::mdlMostrarReservasWhere($tabla, $campo, $valor);

        return $respuesta;
    }

    public function ctrMostrarReservaWhere($tabla, $campo, $valor)
    {
        $respuesta = ReservasModel::mdlMostrarReservaWhere($tabla, $campo, $valor);

        return $respuesta;
    }

    public function mdlMostrar_Ultima_Reserva()
    {
        $tabla = "";
        $respuesta = ReservasModel::mdlMostrar_Ultima_Reserva($tabla);

        return $respuesta;
    }

    public function ctrInsertar($tabla, $datos, $redireccion)
    {
        // Validamos los datos
        $datos = ReservasController::ctrValidarDatos($datos, $redireccion);

        //Insertamos los datos si todo ha salido bien
        $respuesta = ReservasModel::mdlInsertar($tabla, $datos);

        if ($respuesta) {
            echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Clase Reservada',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = '$redireccion';
                }
                showSuccessAlert();
            </script>";
        } else {
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


        //     $crudController = new ReservasController();
        //     $crudController->ctrInsertar($tabla,$datos,$redireccion);
        //     // var_dump($inmueble);
        //   }

    }

    public function ctrActualizar($tabla, $datos, $redireccion, $id)
    {
        // Validamos los datos
        $datos = ReservasController::ctrValidarDatos($datos, $redireccion);

        $respuesta = ReservasModel::mdlActualizar($tabla, $datos, $id);

        if ($respuesta) {
            echo "<script>
                        alert('¡Se ha actualizado correctamente!');
                        window.location = '$redireccion';
                    </script>";
        } else {
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

        //     $crudController = new ReservasController();
        //     $crudController->ctrActualizar($tabla,$datos,$redireccion,$id);
        //     // var_dump($inmueble);
        //   }

    }

    public function ctrEliminar($tabla, $campo_id, $id, $redireccion)
    {
        if (isset($id)) {
            $respuesta = ReservasModel::mdlEliminar($tabla, $campo_id, $id);

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

        //     $crudController = new ReservasController();
        //     $crudController->ctrEliminar($tabla,$redireccion,$id);
        //     // var_dump($inmueble);
        //   }

    }

    public function ctrValidarDatos($datos, $redireccion)
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
            if (isset($valor["tmp_name"]) && $valor["tmp_name"] != null) {
                //Definimo el tamaño maximo de megas
                $tamañoMegas = 2;
                $tamañoMegas = $tamañoMegas * 1048576;
                //Sacamos el tamaño de nuestro fichero
                $tamaño = filesize($valor["tmp_name"]);

                if ($tamaño < $tamañoMegas) {
                    $url = "views/img/inmuebles_images/";
                    $carpeta = $datos["nombre"];
                    $directorio = $url . $carpeta;
                    $nombreFichero = $datos["nombre"];

                    $ficheroValidado = ReservasModel::mdlValidarFichero($valor, $directorio, $nombreFichero);
                    if ($ficheroValidado == "") {
                        echo "<script>
                                alert('¡El tipo de fichero no es el correcto!');
                                window.location = '$redireccion';
                            </script>";

                        return;
                    }
                } else {
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

    // Cargar Paginacion
    public function ctrMostrarPaginacion($tabla,$pagina,$registrosxpagina){
        $orden="ASC";
        

        if ($pagina==1) {
            $inicio=0;
        }else {
            $inicio=($pagina*$registrosxpagina)-$registrosxpagina;
        }
        
        $respuesta = ReservasModel::mdlMostrarPaginacion($tabla,$inicio,$registrosxpagina,$orden);

        return $respuesta;
    }

    //Ultimas 6 reservas
    public function ctrMostrarReservasExpiradas($campo, $valor)
    {
        // $tabla = "";
        $respuesta = ReservasModel::mdlMostrarReservasExpiradas($campo, $valor);

        return $respuesta;
    }

    //Ultimas 6 reservas
    public function ctrMostrarReservasSinExpirar($campo, $valor)
    {
        // $tabla = "";
        $respuesta = ReservasModel::mdlMostrarReservasSinExpirar($campo, $valor);

        return $respuesta;
    }

    public function formatearFecha($fechaOriginal) {
        $datetime = new DateTime($fechaOriginal);
        return $datetime->format('d/m/Y H:i');
    }


}
