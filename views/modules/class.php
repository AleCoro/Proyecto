<?php

  $areasAcademicasController = new AreasAcademicasController();
  $areasAcademicas = $areasAcademicasController->ctrMostrarRegistros("areas_academicas");



  include("views/partials/classView.php");