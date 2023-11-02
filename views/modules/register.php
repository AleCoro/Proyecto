<?php
    // Calcular la fecha mínima
    $fechaMinima = date("Y-m-d", strtotime("-18 years"));

    // Verifica si se envió el formulario
    if (isset($_POST["nuevoUsuario"]) && !empty($_POST["nuevoUsuario"])) {

        $fechaNacimiento = $_POST["fecha"];

        // Verifica si la fecha de nacimiento es válida y cumple con la edad mínima
        if (strtotime($fechaNacimiento) > strtotime($fechaMinima)) {
            $respuesta =  '<br><div class="alert alert-danger">Debes tener al menos 18 años.</div>';
        } else {
            $loginController = new LoginController();
            $respuesta = $loginController->ctrRegister();
        }
    }

    $areasAcademicasController = new AreasAcademicasController();
    $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

    // var_dump($areasAcademicas);

    include("views/partials/registerView.php");