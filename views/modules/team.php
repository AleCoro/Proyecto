<?php

  $rolesController = new RolesController();
  $usuariosController = new UsuariosController();
  $areasAcademicasController = new AreasAcademicasController();

  $datosProfesores = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "2");

  // Sacamos todas las areas academicas para el cuadro combinado
  $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

  if (isset($_POST["id_area"]) && !empty($_POST["id_area"])) {
    //Profesores filtrados por area
    $profesores = $usuariosController->ctrDatosProfesor($_POST["id_area"]);
  } else {
    //Todos los profesores
    $profesores = $usuariosController->ctrDatosProfesor(null);
  }


include("views/partials/teamView.php");
