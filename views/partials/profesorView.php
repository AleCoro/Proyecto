<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
    <h3 class="display-3 font-weight-bold text-white"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></p>
    </div>
  </div>
</div>
<!-- Header End -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="<?= "admin/" . $profesor["foto"] ?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></h3>

            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Followers</b> <a class="float-right">1,322</a>
              </li>
              <li class="list-group-item">
                <b>Following</b> <a class="float-right">543</a>
              </li>
              <li class="list-group-item">
                <b>Friends</b> <a class="float-right">13,287</a>
              </li>
            </ul>

            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sobre mi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">Malibu, California</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

            <p class="text-muted">
              <span class="tag tag-danger">UI Design</span>
              <span class="tag tag-success">Coding</span>
              <span class="tag tag-info">Javascript</span>
              <span class="tag tag-warning">PHP</span>
              <span class="tag tag-primary">Node.js</span>
            </p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#calendario" data-toggle="tab">Disponibilidad</a></li>
              <li class="nav-item"><a class="nav-link" href="#valoraciones" data-toggle="tab">Valoraciones</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="calendario">
                <div id="calendarioReserva"></div>
              </div>
              <div class="tab-pane" id="valoraciones">
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  cargarCalendario(<?= $profesor["id_usuario"] ?>);
</script>

<!-- Modal -->
<div class="modal fade" id="modalReserva" tabindex="-1" role="dialog" aria-labelledby="nombreAsignatura" aria-hidden="true">
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nombreAsignatura" name="nombreAsignatura">Título del Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="descripcion">
          <p>Contenido del modal. Puedes agregar texto, imágenes u otros elementos aquí.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Reservar</button>
        </div>
      </div>
    </div>
    <input type="hidden" name="accion" value="reservar">
    <input type="hidden" id="id_alumno" name="id_alumno" value="<?php echo (isset($_SESSION["id_usuario"])) ? $_SESSION["id_usuario"] : ""; ?>">
    <input type="hidden" id="id_profesor" name="id_profesor" value="<?= $profesor["id_usuario"]; ?>">
    <input type="hidden" id="id_asignatura" name="id_asignatura" value="">
    <input type="hidden" id="precio" name="precio" value="">
    <input type="hidden" id="fecha_clase" name="fecha_clase" value="">
    <input type="hidden" id="id_imparte" name="id_imparte" value="">
  </form>
</div>

<!-- Formulario -->
<form action="login" id="formReserva" method="post" class="d-none">
  <input type="hidden" name="accion" value="reserva">
  <input type="hidden" name="profesor" value="<?= $_POST["id_profesor"]; ?>">
</form>

<?php
if (isset($_POST["accion"]) && $_POST["accion"] == "reservar") {
  // Si no has iniciado sesion te manda al login
  if (count($_SESSION) == 0) {
    echo "<script> document.getElementById('formReserva').submit(); </script>";
  }
}
?>