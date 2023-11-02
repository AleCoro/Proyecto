<?php

  $areasAcademicasController = new AreasAcademicasController();
  $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

  if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
  } else {
    $pagina = 1;
  }

  $registrosxpagina=6;

  $areasAcademicasPaginadas = $areasAcademicasController->ctrMostrarPaginacion("areas_academicas", $pagina, $registrosxpagina);
  $total=Count($areasAcademicas);
  $paginas=ceil($total/$registrosxpagina);


  include("views/partials/classView.php");