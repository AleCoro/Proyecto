<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administración</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Profesores</a></li>
            <li class="breadcrumb-item active">Administracion</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Añadir Profesor</button>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <!-- <th style="width: 10px;">Nº</th> -->
              <th style="width: 10px;">Id</th>
              <!-- <th>Foto</th> -->
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Fecha Nacimiento</th>
              <!-- <th>Ultimo acceso</th> -->
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($profesores as $profesor) { ?>
              <tr>
                <!-- <td></td> -->
                <td><?= $profesor["id_usuario"]; ?></td>
                <!-- <td></td> -->
                <td><?= $profesor["nombre"] . " " . $profesor["apellidos"]; ?></td>
                <td><?= $profesor["direccion"]; ?></td>
                <td><?= $profesor["telefono"]; ?></td>
                <td><?= $profesor["email"]; ?></td>
                <td><?= $profesor["fecha_nacimiento"]; ?></td>
                <!-- <td></td> -->
                <td>
                  <div class="form-group d-flex">
                    <button type="button" class="btn btn-warning mr-1" onclick='editarProfesor(<?= json_encode($profesor); ?>)'>
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <?php if ($_SESSION["id_usuario"] !== $profesor["id_usuario"]) { ?>
                      <form action="" method="post">
                        <input type="hidden" name="id_usuario" value="<?= $profesor["id_usuario"]; ?>">
                        <input type="hidden" name="accion" value="EliminarProfesor">
                        <button type="submit" class="btn btn-danger">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    <?php } ?>
                  </div>
                </td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <!-- <th style="width: 10px;">Nº</th> -->
              <th style="width: 10px;">Id</th>
              <!-- <th>Foto</th> -->
              <th>Nombre</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Fecha Nacimiento</th>
              <!-- <th>Ultimo acceso</th> -->
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>

<!-- Modal Editar Profesor -->
<div class="modal fade" id="formularioEditarProfesorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <form method="POST" action="profesores" id="formularioEditarProfesor">
    <input type="hidden" name="accion" value="EditarProfesor">
    <input type="hidden" name="edit_id" id="edit_id" value="">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Editar Profesor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputState">Usuario:</label>
              <input type="text" class="form-control" name="edit_usuario" id="edit_usuario" required>
            </div>
            <div class="form-group col-md-3">
              <label for="inputState">Nombre:</label>
              <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" required>
            </div>
            <div class="form-group col-md-3">
              <label for="inputState">Apellidos:</label>
              <input type="text" class="form-control" name="edit_apellidos" id="edit_apellidos" required>
            </div>
            <div class="form-group col-md-3">
              <label for="inputState">Telefono:</label>
              <input type="text" class="form-control" name="edit_telefono" id="edit_telefono" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Direccion:</label>
              <input type="text" class="form-control" name="edit_direccion" id="edit_direccion" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Correo:</label>
              <input type="email" class="form-control" name="edit_email" id="edit_email" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Fecha Nacimiento:</label>
              <input type="date" class="form-control" name="edit_fecha_nacimiento" id="edit_fecha_nacimiento" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger btn-pill" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success btn-pill">Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>