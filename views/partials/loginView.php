    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Login</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Login</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Login Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 w-50 m-auto">
            <form action="" method="post">
              <input type="hidden" name="profesor" value="<?php echo (isset($_POST["profesor"])) ? $_POST["profesor"] : "" ;?>">
              <?php if (isset($_POST["accion"])) { ?>
                <input type="hidden" name="accion" value="<?= $_POST["accion"];?>">
                <input type="hidden" name="id_profesor" value="<?= $_POST["profesor"]; ?>">
              <?php } ?>
              <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Introduce tu usuario'" placeholder="Usuario">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'" placeholder="Enter password">
              </div>
              <button type="submit" class="btn btn-primary col-4 mb-4">Iniciar Sesión</button>
              
              <!-- Register buttons -->
              <div class="text-center">
                <p>¿No tienes cuenta? <a href="register">Registrate</a></p>
                <p>or sign up with:</p>
                <button type="button" class="btn btn-secondary btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-secondary btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-secondary btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-secondary btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div>
            </form>
            <?php if(isset($respuesta)){echo $respuesta;}?>
          </div>
        </div>
      </div>
    </div>
    <!-- Login End -->
    <form action="profesor" id="continuarReserva" method="post">
      <input type="hidden" name="id_profesor" value="<?php echo (isset($_POST["profesor"])) ? $_POST["profesor"] : "" ;?>">
    </form>

    <?php 
    if (isset($respuesta) && $respuesta=="profesor") {
      echo "<script> document.getElementById('continuarReserva').submit(); </script>";
    }
    if (isset($respuesta) && $respuesta=="inicio") {
      echo '<script>window.location="inicio"</script>';
    }
    
    
    
    
    ?>