<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="inicio" class="nav-link">Inicio</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Perfil Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php foreach ($nombresRoles as $nombreRol) { ?>
              <form action="" method="post" name="miFormulario<?= $nombreRol["id_rol"]; ?>">
                <button onclick="document.getElementById('miFormulario<?= $nombreRol['id_rol']; ?>').submit()" class="dropdown-item"><?= $nombreRol["nombre_rol"]; ?></button>
                <input type="hidden" name="perfilSeleccionado" value="<?= $nombreRol["id_rol"]; ?>">
              </form>
              <div class="dropdown-divider"></div>
            <?php } ?>
            <a href="logout" class="nav-link">Logout</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->