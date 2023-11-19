<?php

if (isset($_SESSION["id_usuario"])) {
  $rolesController = new RolesController();
  $roles = $rolesController->ctrMostrarRegistrosWhere("es_un", "usuario", $_SESSION["id_usuario"]);

  // Extrae los valores de "rol" en un nuevo array
  if (count($roles) > 1) {
    $ids = array_column($roles, 'rol');

    // Convierte el array en una cadena de valores separados por comas
    $cadenaIds = implode(', ', $ids);
  } else {
    $cadenaIds = $roles[0]["rol"];
  }

  $nombresRoles = $rolesController->ctrMostrarRegistrosWhereIn("roles", "id_rol", $cadenaIds);

  if (isset($_POST["perfilSeleccionado"])) {
    $_SESSION["perfilSeleccionado"] = $_POST["perfilSeleccionado"];
  }
}

if (isset($_SESSION["id_usuario"]) && !isset($_SESSION["perfilSeleccionado"]) && count($roles) > 1) {
  echo "    <script>
          $(document).ready(function() {
            $('#seleccionPerfilModal').modal({backdrop: 'static', keyboard: false});
            $('#seleccionPerfilModal').modal('show');
            
          });
        </script>";
}

if (isset($roles) && count($roles) < 2) {
  $_SESSION["perfilSeleccionado"]=$roles[0]["rol"];
}

include("views/partials/inicioView.php");
