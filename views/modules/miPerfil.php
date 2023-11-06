<?php
    $usuariosController = new UsuariosController();
    $rolesController = new RolesController();
    $areasAcademicasController = new AreasAcademicasController();
    $asignaturasController = new AsignaturasController();
    // $reservasController = new ReservasController();

    $usuario = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $_SESSION["id_usuario"]);
    $rolesUsuario = $rolesController->ctrMostrarRegistrosWhere("es_un","usuario",$usuario["id_usuario"]);
    $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

    // Sacamos los datos si es profesor
    if ($_SESSION["perfilSeleccionado"]==2) {
        $datosProfesor = $usuariosController->ctrDatosProfesor($_SESSION["id_usuario"]);
    }
    // Sacamos los datos si es alumno
    if ($_SESSION["perfilSeleccionado"]==3) {
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
        $asignaturasController->ctrInsertar("imparte",$datos,null);

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
        $usuariosController->ActualizarUsuario('usuarios',$datos,null,$_POST["id_usuario"]);
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

    var_dump($_POST);

  include("views/partials/miPerfilView.php");