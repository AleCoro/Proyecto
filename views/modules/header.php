<?php
  if (isset($_GET["ruta"])) {
    $ruta = $_GET["ruta"];
  }else {
    $ruta = "inicio";
  }

  // Define un arreglo de enlaces y sus correspondientes URLs
  $nav_links = array(
    'Home' => 'inicio',
    'Clases' => 'class',
    'Profesores' => 'team',
    'Galeria' => 'gallery',
    'Contacto' => 'contact',
    'Sobre nosotros' => 'about'
  );

  if (isset($_SESSION["id_usuario"])) {
    $rolesController = new RolesController();
    $roles = $rolesController->ctrMostrarRegistrosWhere("es_un", "usuario", $_SESSION["id_usuario"]);

    // Extrae los valores de "rol" en un nuevo array
    if (count($roles)>1) {
      $ids = array_column($roles, 'rol');

      // Convierte el array en una cadena de valores separados por comas
      $cadenaIds = implode(', ', $ids);
    }else {
      $cadenaIds = $roles[0]["rol"];
    }

    $nombresRoles = $rolesController->ctrMostrarRegistrosWhereIn("roles", "id_rol", $cadenaIds);

    // Comprueba si has seleccionado otro rol
    if (isset($_POST["perfilSeleccionado"])) {
      $_SESSION["perfilSeleccionado"] = $_POST["perfilSeleccionado"];
    }
    
    // Comprueba si solo tiene un rol
    if (count($nombresRoles)==1) {
      $_SESSION["perfilSeleccionado"] = $nombresRoles[0]["id_rol"];
    }

  }
  


  include("views/partials/headerView.php");