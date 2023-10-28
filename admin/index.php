<?php
    require_once("controlers/plantilla.controller.php");
    
    require_once("controlers/usuarios.controller.php");
    require_once("models/usuarios.model.php");

    require_once("controlers/roles.controller.php");
    require_once("models/roles.model.php");

    require_once("controlers/asignaturas.controller.php");
    require_once("models/asignaturas.model.php");


    $plantilla = new PlantillaController();
    $plantilla->ctrPlantilla();