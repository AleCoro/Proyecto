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
            <li class="breadcrumb-item"><a href="#">Alumnos</a></li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Añadir Alumno</button>
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
            <?php foreach ($alumnos as $alumno) { ?>
              <tr>
                <!-- <td></td> -->
                <td><?= $alumno["id_usuario"]; ?></td>
                <!-- <td></td> -->
                <td><?= $alumno["nombre"] . " " . $alumno["apellidos"]; ?></td>
                <td><?= $alumno["direccion"]; ?></td>
                <td><?= $alumno["telefono"]; ?></td>
                <td><?= $alumno["email"]; ?></td>
                <td><?= $alumno["fecha_nacimiento"]; ?></td>
                <!-- <td></td> -->
                <td>
                  <div class="form-group d-flex">
                    <button type="button" class="btn btn-warning mr-1">
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger">
                      <i class="fas fa-trash-alt"></i>
                    </button>
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