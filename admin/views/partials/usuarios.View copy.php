<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Administración</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Añadir Usuario</button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">Id</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo acceso</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Usuario Administrador</td>
                <td>admin</td>
                <td>
                  <img src="views/dist/img/user1-128x128.jpg" alt="anonimo" class="img-thumbnail" width="35px">
                </td>
                <td>Administrador</td>
                <td>
                  <button class="btn btn-success btn-xs">Activado</button>
                </td>
                <td>2022-12-9 12:17:15</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning">
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <button class="btn btn-danger">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
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
  <!-- The Modal -->
  <div class="modal" id="modalAgregarUsuario">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" action="" method="post" enctype="multipart/form-data">
          <!-- Modal Header -->
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Añadir usuario</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <!-- nombre -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" name="nuevoNombre" placeholder="Introduce el nombre" required="">
            </div>
            <!-- usuario -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="text" class="form-control" name="nuevoUsuario" placeholder="Introduce el usuario" required="">
            </div>
            <!-- pasword -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="text" class="form-control" name="nuevoPassword" placeholder="Introduce el password" required="">
            </div>
            <!-- perfil -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
              </div>
              <select class="form-control" name="nuevoPerfil">
                <option value="">Selecionar el perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
            <!-- subir foto -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="views/dist/img/avatar5.png" alt="">
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar usuario</button>
          </div>
        </div>
      </form>
    </div>
  </div>
