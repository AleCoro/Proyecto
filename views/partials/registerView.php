    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Register</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Register</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <form action="#" method="post">
          <h3 class="mt-6">Introduce tus datos</h3>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Nombre</label>
              <input type="text" class="form-control" name="nombre" placeholder="Nombre">
              <input type="hidden" name="nuevoUsuario" value="nuevoUsuario">
            </div>
            <div class="form-group col-md-6">
              <label>Apellidos</label>
              <input type="text" class="form-control" name="apellidos" placeholder="Apellidos">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Usuario</label>
              <input type="text" class="form-control" name="Usuario" placeholder="Usuario">
            </div>
            <div class="form-group col-md-6">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label>Direccion</label>
            <input type="text" class="form-control" name="direccion" placeholder="Direccion">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Email</label>
              <input type="email" class="form-control" name="Email" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label>Fecha Nacimiento</label>
              <input type="date" class="form-control" name="fecha" placeholder="Fecha Nacimiento" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Selecciona tu rol de usuario</label>
              <select name="rol" id="rol" onchange="habilitarCampos()" class="form-control">
                <option selected>Selecciona</option>
                <option>Profesor</option>
                <option>Alumno</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Telefono</label>
              <input type="text" class="form-control" name="telefono" placeholder="Telefono">
            </div>
          </div>

          <!-- Campos Profesor -->
          <div id="porfesor" class="d-none">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Selecciona la asignatura</label>
                <select name="asignatura" id="asignatura" onchange="habilitarCampos()" class="form-control">
                  <option selected>Selecciona</option>
                  <option>PHP</option>
                  <option>CSS</option>
                  <option>HTML</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Precio/hora</label>
                <input type="number" class="form-control" name="precio" placeholder="Precio">
              </div>
            </div>
          </div>


          <button type="submit" class="btn btn-primary">Registrate</button>
        </form>
      </div>
    </div>
    <!-- Contact End -->

    <script languaje="javascript">
      function habilitarCampos() {
        rol = document.getElementById("rol").value;
        if (rol == "Profesor") {
          document.getElementById("porfesor").className = "d-block";
        }
        if (rol == "Alumno") {
          document.getElementById("porfesor").className = "d-none";
        }
      }
    </script>