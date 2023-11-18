<?php
$usuariosController = new UsuariosController();
$rolesController = new RolesController();
$areasAcademicasController = new AreasAcademicasController();
$asignaturasController = new AsignaturasController();
$reservasController = new ReservasController();

$usuario = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $_SESSION["id_usuario"]);
$rolesUsuario = $rolesController->ctrMostrarRegistrosWhere("es_un", "usuario", $usuario["id_usuario"]);
$areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

// Sacamos los datos si es profesor
if ($_SESSION["perfilSeleccionado"] == 2) {
    $datosProfesor = $usuariosController->ctrDatosProfesor($_SESSION["id_usuario"]);
}
// Sacamos los datos si es alumno
if ($_SESSION["perfilSeleccionado"] == 3) {
    $datosAlumno = $usuariosController->ctrDatosAlumno($_SESSION["id_usuario"]);
}

//Metemos en un array solo el rol de ese usuario
foreach ($rolesUsuario as $rolUsuario) {
    $usuarioRoles[] = $rolUsuario["rol"];
}

// Añadimos un rol a nuestro usuario
if (isset($_POST["addRol"])) {
    $datos["usuario"] = $_SESSION["id_usuario"];
    $datos["rol"] = $_POST["addRol"];

    $rolesController->ctrInsertar("es_un", $datos);
    echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Ya puedes seleccionar tu rol nuevo',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'miPerfil';
                }
                showSuccessAlert();
            </script>";
}

//Guardamos si quiere impartir nuevas asignaturas
if (isset($_POST["impartir"])) {
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    $fechaHora = $fecha . ' ' . $hora;

    // Convierte la fecha y hora en un objeto DateTime
    $dateTime = new DateTime($fechaHora);

    // Formatea la fecha y hora en el formato MySQL DATETIME
    $datos["asignatura"] = $_POST["asignaturas"];
    $datos["profesor"] = $_SESSION["id_usuario"];
    $datos["precio"] = $_POST["precio"];
    $datos["fecha_imparte"] = $dateTime->format('Y-m-d H:i:s');
    // var_dump($datos);
    $asignaturasController->ctrInsertar("imparte", $datos, null);

    echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'miPerfil';
                }
                showSuccessAlert();
            </script>";
}

//Editamos nuestro perfil
if (isset($_POST["accion"]) && $_POST["accion"] == "editarPerfil") {
    $datos = array(
        "nombre" => $_POST["nombre"],
        "apellidos" => $_POST["apellidos"],
        "usuario" => $_POST["usuario"],
        "password" => $_POST["password"],
        "direccion" => $_POST["direccion"],
        "telefono" => $_POST["telefono"],
        "email" => $_POST["email"],
        "fecha_nacimiento" => $_POST["fecha"]
    );

    if (isset($_FILES["foto"]["tmp_name"]) && $_FILES["foto"]["tmp_name"] !== "") {

        //Definimo el tamaño maximo de megas
        $sizeMegas = 2;
        $sizeMegas = $sizeMegas * 1048576;
        //Sacamos el tamaño de nuestro fichero
        $size = filesize($_FILES["foto"]["tmp_name"]);

        if ($size < $sizeMegas) {
            list($ancho, $alto) = getimagesize($_FILES["foto"]["tmp_name"]);
            $nuevoAncho = 300;
            $nuevoAlto = 300;

            // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
            if ($_FILES["foto"]["type"] == "image/jpeg") {
                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/usuarios/" . $_POST["id_usuario"] . "-" . $_POST["usuario"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, "admin/" . $ruta);
            }

            if ($_FILES["foto"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/usuarios/" . $_POST["id_usuario"] . "-" . $_POST["usuario"] . ".png";
                $origen = imagecreatefrompng($_FILES["foto"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, "admin/" . $ruta);
            }

            if (!isset($destino)) {
                echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Tipo de fichero incorrecto',
                            showConfirmButton: false,
                            timer: 1400
                        });
                        window.location.href = 'miPerfil';
                    }
                    showSuccessAlert();
                </script>";
                return;
            }
        } else {
            echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Fichero demasiado grande',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'miPerfil';
                }
                showSuccessAlert();
            </script>";
            return;
        }

        $datos["foto"] = $ruta;
        $_SESSION["foto"] = $datos["foto"];
    }

    $usuariosController->ActualizarUsuario('usuarios', $datos, null, $_POST["id_usuario"]);




    echo "<script>
            async function showSuccessAlert() {
                await Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Perfil editado correctamente',
                    showConfirmButton: false,
                    timer: 1400
                });
                window.location.href = 'miPerfil';
            }
            showSuccessAlert();
        </script>";
}

//Editamos nuestra clase
if (isset($_POST["accion"]) && $_POST["accion"] == "editarClase") {
    $fecha = $_POST["edit_fecha"];
    $hora = $_POST["edit_hora"];
    $id_imparte = $_POST["edit_id"];

    $fechaHora = $fecha . ' ' . $hora;

    // Convierte la fecha y hora en un objeto DateTime
    $dateTime = new DateTime($fechaHora);

    $datos = array(
        "fecha_imparte" => $dateTime->format('Y-m-d H:i:s'),
        "precio" => $_POST["edit_precio"]
    );

    $asignaturasController->ctrActualizar("imparte", $datos, null, "id_imparte", $id_imparte);
    echo "<script>
            async function showSuccessAlert() {
                await Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Clase editada correctamente',
                    showConfirmButton: false,
                    timer: 1400
                });
                window.location.href = 'miPerfil';
            }
            showSuccessAlert();
        </script>";
}

$reservas = $reservasController->ctrMostrarUltimasReservas("alumno",$usuario["id_usuario"]);

// var_dump($reservas);

include("views/partials/miPerfilView.php");
