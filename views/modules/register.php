<?php
// Calcular la fecha mínima
$fechaMinima = date("Y-m-d", strtotime("-18 years"));

// Verifica si se envió el formulario
if (isset($_POST["nuevoUsuario"]) && !empty($_POST["nuevoUsuario"])) {

    $fechaNacimiento = $_POST["fecha"];

    // Verifica si la fecha de nacimiento es válida y cumple con la edad mínima
    if (strtotime($fechaNacimiento) > strtotime($fechaMinima)) {
        $respuesta =  'Debes tener al menos 18 años';
    } else {
        $loginController = new LoginController();
        $respuesta = $loginController->ctrRegister();
        $usuario = $_POST["Usuario"];
        $email = $_POST["Email"];
    }

    if ($respuesta == "") {
        echo "<script>
                enviarCorreoRegistro('" . $usuario . "','" . $email . "');
            </script>";
    } else {
        echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: '$respuesta',
                            showConfirmButton: false,
                            timer: 1400
                        });
                    }
                    showSuccessAlert();
                </script>";
    }
}

$areasAcademicasController = new AreasAcademicasController();
$areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

// var_dump($areasAcademicas);

include("views/partials/registerView.php");
