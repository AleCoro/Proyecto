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
                <th style="width: 10px;">Nº</th>
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
              <form action="usuarios" method="post">
                <?php
                $campo = null;
                $valor = null;

                $mostrarUsuarios = new ControladorUsuarios();
                $usuarios = $mostrarUsuarios->ctrMostrarUsuarios($campo, $valor);

                foreach ($usuarios as $key => $value) { ?>
                  <tr>
                    <td><?=($key+1)?></td>
                    <td><?=($value["id"])?></td>
                    <td><?=($value["nombre"])?></td>
                    <td><?=($value["usuario"])?></td>
                    <?php
                      if ($value["foto"] != "") {
                    ?>
                      <td><img src="<?=$value["foto"]?>" class="img-circle elevation-2" width="35px"></td>
                    <?php
                      }else {
                    ?>
                      <td><img src="views/dist/img/user1-128x128.jpg" alt="anonimo" class="img-circle elevation-2" width="35px"></td>
                    <?php
                      }
                      
                    ?>

                    <td><?=($value["perfil"])?></td>
                    <?php
                      if ($value["estado"] != 0) {
                    ?>
                    <td>
                      <form action="activar" method="post">
                        <input type="hidden" name="estado" value="<?= $value["estado"]?>">
                        <input type="hidden" name="id" value="<?= $value["id"]?>">
                        <button class="btn btn-success btn-xm">Activado</button>
                      </form>
                    </td>
                    <?php
                      }else {
                    ?>
                    <td>
                      <form action="activar" method="post">
                        <input type="hidden" name="estado" value="<?= $value["estado"]?>">
                        <input type="hidden" name="id" value="<?= $value["id"]?>">
                        <button class="btn btn-danger btn-xm">Desactivado</button>
                      </form>
                    </td>
                    <?php
                      }
                    ?>

                    <td><?=$value["ultimo_login"]?></td>
              </form>
                    <td>
                      <div class="form-group" style="display: flex;">
                        <form action="editar" method="post">
                          <input type="hidden" name="editarUsuario" value="<?= $value["usuario"] ?>">
                          <button type="submit" class="btn btn-warning">
                            <i class="fas fa-user-edit"></i>
                          </button>
                        </form>
                        <form action="eliminar" method="post">
                          <input type="hidden" name="id" value="<?= $value["id"] ?>">
                          <input type="hidden" name="usuario" value="<?= $value["usuario"] ?>">
                          <input type="hidden" name="foto" value="<?= $value["foto"] ?>">
                          <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
              <?php
                }
              ?>
              
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
        <form role="form" action="" method="POST" enctype="multipart/form-data">
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
              <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Introduce el usuario" required="">
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
              <img src="views/dist/img/avatar5.png" class="thumbnail previsualizar" width="100px" alt="">
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar usuario</button>
          </div>
          <?php
            $crearUsuario = new ControladorUsuarios();
            $crearUsuario->ctrCrearUsuario();
          ?>
        </form>
      </div>
    </div>
  </div>
