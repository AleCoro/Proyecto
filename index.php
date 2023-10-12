<?php
    require_once "controllers/plantilla.controller.php";
    require_once "controllers/ruta.controller.php";

    require_once "controllers/login.controller.php";
    require_once "models/login.model.php";

    require_once "controllers/roles.controller.php";
    require_once "models/roles.model.php";

    require_once "controllers/clases.controller.php";
    require_once "models/clases.model.php";
    
    $plantilla = new PlantillaController();
    $plantilla->ctrPlantilla();