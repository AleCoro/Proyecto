<?php
    require_once("controlers/plantilla.controller.php");
    
    require_once("controlers/usuarios.controller.php");
    require_once("models/usuarios.model.php");

    require_once("controlers/roles.controller.php");
    require_once("models/roles.model.php");


    $plantilla = new PlantillaController();
    $plantilla->ctrPlantilla();