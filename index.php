<?php
    require_once "controllers/plantilla.controller.php";
    require_once "controllers/ruta.controller.php";

    require_once "controllers/login.controller.php";
    require_once "models/login.model.php";

    require_once "controllers/roles.controller.php";
    require_once "models/roles.model.php";

    require_once "controllers/asignaturas.controller.php";
    require_once "models/asignaturas.model.php";

    require_once "controllers/areasAcademicas.controller.php";
    require_once "models/areasAcademicas.model.php";

    require_once "controllers/usuarios.controller.php";
    require_once "models/usuarios.model.php";

    require_once "controllers/reservas.controller.php";
    require_once "models/reservas.model.php";
    
    $plantilla = new PlantillaController();
    $plantilla->ctrPlantilla();