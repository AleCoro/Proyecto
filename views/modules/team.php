<?php

  $rolesController = new RolesController();
  $usuariosController = new UsuariosController();
  $areasAcademicasController = new AreasAcademicasController();
  $reservasController = new ReservasController();

  $datosProfesores = $rolesController->ctrMostrarRegistrosWhere("es_un", "rol", "2");
  $profesores = $usuariosController->ctrDatosProfesorPorArea(null);

  // Sacamos todas las areas academicas para el cuadro combinado
  $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");


include("views/partials/teamView.php");
