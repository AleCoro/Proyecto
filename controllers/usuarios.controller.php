<?php
class UsuariosController
{
    // ====================================== MOSTRAR USUARIOS ======================================

    public function ctrMostrarUsuarios()
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla);
        return $respuesta;
    }

    // ====================================== MOSTRAR USUARIO WHERE ======================================

    public function ctrMostrarUsuarioWhere($campo, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarioWhere($tabla, $campo, $valor);
        return $respuesta;
    }

    // ====================================== BORRAR USUARIO ======================================

    public function ctrBorrarUsuario($id, $tabla, $redireccion, $foto)
    {
        if (isset($id)) {
            if ($foto != "") {
                unlink($foto);
                rmdir('views/img/usuarios/' . $id);
            }

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $id);

            return $respuesta;
        }
    }


    // ====================================== ACTUALIZAR USUARIO ======================================

    public function ActualizarUsuario($tabla, $datos, $redireccion, $id)
    {
        // Validamos los datos
        $datos = UsuariosController::ValidarDatos($datos, $redireccion);

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $datos, $id);

        return $respuesta;
    }

    // ====================================== VALIDAR DATOS ======================================

    public function ValidarDatos($datos, $redireccion)
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

                    $ficheroValidado = ModeloUsuarios::mdlValidarFichero($valor, $directorio, $nombreFichero);
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

    // ====================================== CONSULTA MULTITABLA ======================================

    public function ctrDatosProfesorPorArea($area)
    {
        $respuesta = ModeloUsuarios::mdlDatosProfesorPorArea($area);
        return $respuesta;
    }

    // ====================================== CONSULTA DATOS PROFESOR ======================================

    public function ctrDatosProfesor($profesor)
    {
        $respuesta = ModeloUsuarios::mdlDatosProfesor($profesor);
        return $respuesta;
    }

    // ====================================== CONSULTA DATOS ALUMNO ======================================

    public function ctrDatosAlumno($alumno)
    {
        $respuesta = ModeloUsuarios::mdlDatosAlumno($alumno);
        return $respuesta;
    }

    // ====================================== CONSULTA PROFESOR MAS VALORADOS ======================================

    public function ctrProfesorMejorValorados()
    {
        $respuesta = ModeloUsuarios::mdlProfesorMejorValorados();
        return $respuesta;
    }
}
