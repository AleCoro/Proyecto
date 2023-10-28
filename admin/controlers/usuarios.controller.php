<?php
class UsuariosController
{
    // ====================================== INGRESO DE USUARIO ======================================

    public function ctrIngresoUsuario()
    {
        if (isset($_POST["usuario"])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
            ) {


                $tabla = "usuarios";
                $campo = "usuario";
                $encriptada = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $valor = $_POST["usuario"];


                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);


                if (is_array($respuesta)) {
                    if ($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $encriptada) {

                        if ($respuesta["estado"] == 1) {
                            $_SESSION["session_iniciada"] = "SI";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["usuario"] = $respuesta["usuario"];
                            $_SESSION["foto"] = $respuesta["foto"];
                            $_SESSION["perfil"] = $respuesta["perfil"];


                            // ALMACENAR FECHA PARA SABER EL ÚLTIMO LOGIN

                            $fecha = date('Y-m-d');
                            $hora = date('H:i:s');
                            $fechaActual = $fecha . ' ' . $hora;

                            $campo1 = "ultimo_login";
                            $valor1 = $fechaActual;

                            $campo2 = "id";
                            $valor2 = $respuesta["id"];

                            $ultimoLogin = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);

                            if ($ultimoLogin == 'SI') {
                                header("Location: inicio");
                            }
                        } else {
                            echo '<br><div class="alert alert-danger">Este usuario se encuentra desactivado actualmente</div>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger">Error en el login, vuelve a intentarlo</div>';
                    }
                }
            }
        }
    }

    // ====================================== ALTA DE USUARIO ======================================

    public function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoUsuario"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
            ) {

                // VALIDAR IMAGEN
                $ruta = "";
                if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    $nuevoAncho = 350;
                    $nuevoAlto = 350;

                    // CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                    $directorio = "views/img/usuarios/" . $_POST["nuevoUsuario"];
                    mkdir($directorio, 0755);

                    // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

                        // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".jpeg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {

                        // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        $ruta = "views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $_POST["nuevoUsuario"] . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";
                $encriptada = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptada,
                    "perfil" => $_POST["nuevoPerfil"],
                    "foto" => $ruta
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
                // var_dump($respuesta);
                if ($respuesta == "SI") {
                    echo "<script>
                                alert('¡El usuario ha sido guardado correctamente!');
                                window.location = 'usuarios';
                            </script>";
                }
            } else {

                echo "<script>
                        alert('¡El usuario no puede ir vacío o llevar caracteres especiales!');
                        window.location = 'usuarios';
                    </script>";
            }
        }
    }

    // ====================================== EDITAR USUARIO ======================================

    public function ctrEditarUsuario()
    {
        if (empty($_POST["editarNombre"])) {
            $_POST["editarNombre"] = $_POST["nombreActual"];
        }

        if ($_POST["editarPassword"] != "") {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                $encriptada = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            } else {
                echo "<script>
                            alert('¡La contraseña no puede llevar caracteres especiales!');
                            if(result.value){
                                window.location = 'editar';
                            }
                            </script>";
            }
        } else {
            $encriptada = $_POST["passwordActual"];
        }

        if (empty($_POST["editarPerfil"])) {
            $_POST["editarPerfil"] = $_POST["perfilActual"];
        }

        if (isset($_POST["usuarioActual"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
                // VALIDAR IMAGEN
                $ruta = $_POST["fotoActual"];
                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                    $nuevoAncho = 350;
                    $nuevoAlto = 350;

                    // CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                    $directorio = "views/img/usuarios/" . $_POST["usuarioActual"];


                    if (!empty($_POST["fotoActual"])) {
                        unlink($_POST["fotoActual"]);
                    } else {
                        mkdir($directorio, 0755);
                    }

                    // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                        // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        $ruta = "views/img/usuarios/" . $_POST["usuarioActual"] . "/" . $_POST["usuarioActual"] . ".jpeg";
                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarFoto"]["type"] == "image/png") {

                        // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        $ruta = "views/img/usuarios/" . $_POST["usuarioActual"] . "/" . $_POST["usuarioActual"] . ".png";
                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                $datos = array(
                    "nombre" => $_POST["editarNombre"],
                    "usuario" => $_POST["usuarioActual"],
                    "password" => $encriptada,
                    "perfil" => $_POST["editarPerfil"],
                    "foto" => $ruta
                );

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                if ($respuesta == "SI") {
                    echo "<script>
                            alert('¡El usuario ha sido guardado correctamente!');
                            window.location = 'usuarios';
                        </script>";
                }
            } else {
                echo "<script>
                        alert('¡El usuario no puede ir vacío o llevar caracteres especiales!');
                        window.location = 'usuarios';
                    </script>";
            }
        }
    }

    // ====================================== MOSTRAR USUARIOS ======================================

    public function ctrMostrarUsuarios($campo, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);
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

            if ($respuesta) {
                echo "<script>
                        alert('¡Se ha eliminado correctamente!');
                        window.location = '$redireccion';
                    </script>";
            }else {
                echo "<script>
                    alert('¡Error al eliminar!');
                    window.location = '$redireccion';
                </script>";
            }
        }
    }

    // ====================================== ACTIVAR USUARIO ======================================

    public function ctrActivarUsuario($valor1, $valor2)
    {

        $tabla = "usuarios";
        $campo1 = "estado";
        $campo2 = "id";
        $respuesta = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);

        if ($respuesta == "SI") {
            echo "<script>
                    alert('¡El usuario ha sido activado');
                    window.location = 'usuarios';
                </script>";
        }
    }

    // ====================================== Actualizar USUARIO ======================================

    public function ActualizarUsuario($tabla, $datos, $redireccion, $id)
    {
        // Validamos los datos
        $datos = UsuariosController::ValidarDatos($datos, $redireccion);

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $datos, $id);

        if ($respuesta) {
            echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        redirect: 'alumnos',
                        position: 'top-center',
                        icon: 'success',
                        title: 'Usuario Actualizado',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = '$redireccion';
                }
                showSuccessAlert();
            </script>";
        } else {
            echo "<script>
                alert('¡Error al hacer la actualizacion!');
                window.location = '$redireccion';
            </script>";
        }

    }

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
}
