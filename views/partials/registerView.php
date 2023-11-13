    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Register</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Register</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
          <h3 class="mt-6">Introduce tus datos</h3>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" value = "<?php if(isset($_POST["nombre"])){echo $_POST["nombre"];} ?>" required>
              <input type="hidden" name="nuevoUsuario" value="nuevoUsuario">
            </div>
            <div class="form-group col-md-6">
              <label>Apellidos</label>
              <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value = "<?php if(isset($_POST["apellidos"])){echo $_POST["apellidos"];} ?>" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Usuario</label>
              <input type="text" class="form-control" name="Usuario" placeholder="Usuario" value = "<?php if(isset($_POST["Usuario"])){echo $_POST["Usuario"];} ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password" value = "<?php if(isset($_POST["password"])){echo $_POST["password"];} ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label>Direccion</label>
            <input type="text" class="form-control" name="direccion" placeholder="Direccion" value = "<?php if(isset($_POST["direccion"])){echo $_POST["direccion"];} ?>" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" name="Email" placeholder="Email" value = "<?php if(isset($_POST["Email"])){echo $_POST["Email"];} ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Fecha Nacimiento</label>
              <input type="date" class="form-control" name="fecha" placeholder="Fecha Nacimiento" value = "<?php if(isset($_POST["fecha"])){echo $_POST["fecha"];} ?>" required >
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Selecciona tu rol de usuario</label>
              <select name="rol" id="rol" onchange="habilitarCampos()" class="form-control" required>
                <option value="" selected>Selecciona</option>
                <option>Profesor</option>
                <option>Alumno</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Telefono</label>
              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value = "<?php if(isset($_POST["telefono"])){echo $_POST["telefono"];} ?>" required>
            </div>
          </div>
          <div class="form-row d-flex align-items-center">
            <div class="form-group col-md-6">
                <label for="exampleInputFile">Subir Foto</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="foto" name="foto" required onchange="previsualizarIMG(this, 'previsualizarImg')">
                    <label class="custom-file-label" for="customFile">Sube tu foto</label>
                </div>
            </div>
            <div class="form-group col-md-6 align-content-center">
                <img id="previsualizarImg" src="#" alt="Vista previa de la imagen" style="display: none;" class="w-25 h-25 m-auto rounded-circle">
            </div>
          </div>
          <!-- Contact End -->

          <!-- Campos Profesor Start -->
          <div id="porfesor" class="d-none">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Selecciona el area academica</label>
                <select name="areaAcademica" id="areaAcademica" class="form-control" onchange="cargarAsignaturas()">
                  <option value="" selected>Selecciona</option>
                  <?php foreach ($areasAcademicas as $areaAcademica) { ?>
                    <option value="<?= $areaAcademica["id_area"]?>" ><?= $areaAcademica["nombre_area"]?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Selecciona la asignatura</label>
                <select name="asignaturas" id="asignaturas" class="form-control">
                  <option value="" selected>Selecciona</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha_imparte" id="fecha_imparte" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>
              </div>
              <div class="form-group col-md-3">
                <label>Hora</label>
                <input type="time" class="form-control" name="hora_imparte" id="hora_imparte" min="06:00" max="21:00" required>
              </div>
              <div class="form-group col-md-6">
                <label>Precio/hora</label>
                <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio" min="0">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Registrate</button>
        </form>
        <?php if(isset($respuesta)){echo $respuesta;}?>
      </div>
    </div>
    <!-- Campos Profesor End -->