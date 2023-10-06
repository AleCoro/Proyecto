<?php
    class LoginController{
        // ====================================== INGRESO DE USUARIO ======================================

        public function ctrLogin(){

            if (isset($_POST['usuario'])) {
                $usuario=LoginModel::filtrarVarchar($_POST['usuario']);
                $tabla="usuarios";
                $comprobar = LoginModel::Comprobar_Exisitencia_Registro($tabla,'usuario',$usuario);
                $id_usuario = $comprobar["id_usuario"];
                
                $contraseña = $_POST["password"];
                // $contraseña = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                if ($comprobar!==NULL) {
                    if (isset($contraseña) && !empty($contraseña)) {
                        if ($contraseña==$comprobar["password"]) {
                            $_SESSION["id_usuario"]=$id_usuario;
                            $_SESSION["session_usuario"]=$usuario;
                            echo '<script>window.location="inicio"</script>';
                        }else {
                            echo '<br><div class="alert alert-danger">Error al introducir la contraseña</div>';
                        }
                    }else {
                        echo '<br><div class="alert alert-danger">Rellena la contraseña</div>';
                    }
                }else {
                    echo '<br><div class="alert alert-danger">El usuario no existe</div>';
                }
            }
        }

        // ====================================== REGISTRO DE USUARIO ======================================
        public function ctrRegister(){
            if (isset($_POST["nuevoUsuario"])) {
                $tabla="usuarios";
                $columna="usuario";
                $registro=$_POST["nuevoUsuario"];

                $existe = LoginModel::Comprobar_Exisitencia_Registro($tabla,$columna,$registro);

                if ($existe==null) {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword1"]) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword2"])){

                            $urlUsuarios = "views/img/usuarios/";

                            // VALIDAR Foto
                            $ruta = "";
                            if (isset($_FILES["nuevaFoto"]["tmp_name"]) && $_FILES["nuevaFoto"]["tmp_name"]!=null) {

                                list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                                $nuevoAncho=350;
                                $nuevoAlto=350;

                                // CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                                $directorio = $urlUsuarios.$_POST["nuevoUsuario"];
                                mkdir($directorio, 0755);

                                // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
                                if ($_FILES["nuevaFoto"]["type"]=="image/jpeg") {
                                    $Foto = $_POST["nuevoUsuario"].".jpeg";
                                    
                                    // GUARDAMOS LA Foto EN EL DIRECTORIO
                                    $ruta = $directorio."/".$Foto;
                                    $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                    imagejpeg($destino, $ruta);
                                }

                                if ($_FILES["nuevaFoto"]["type"]=="image/png") {
                                    $Foto = $_POST["nuevoUsuario"].".png";
                                    
                                    // GUARDAMOS LA Foto EN EL DIRECTORIO
                                    $ruta = $directorio."/".$Foto;
                                    $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                    imagepng($destino, $ruta);
                                }
                                
                            }else {
                                $Foto = "default.png";
                                $ruta = $urlUsuarios.$Foto;
                            }
                        
                            $tabla = "usuarios";
                            // $encriptada = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                            if ($_POST["nuevoPassword1"]===$_POST["nuevoPassword2"]) {
                                $NewPassword = $_POST["nuevoPassword1"];
                                $datos = array(
                                    "nombre" => $_POST["nuevoNombre"],
                                    "usuario" => $_POST["nuevoUsuario"],
                                    "password" => $NewPassword,
                                    // "imagen" => $ruta
                                );

                                $respuesta = LoginModel::mdlRegistrarUsuario($tabla, $datos);
                                if ($respuesta == "SI") {
                                    echo "<script>
                                        alert('¡El usuario ha sido guardado correctamente!');
                                        window.location = 'register';
                                    </script>";
                                }else{
                                    echo "<script>
                                        alert('¡Error al guardar el usuario!');
                                        window.location = 'register';
                                    </script>";
                                }
                            }else {
                                echo "<script>
                                        alert('¡Las contraseñas no coinciden!');
                                        window.location = 'register';
                                    </script>";
                            }
                    }else{

                        echo "<script>
                            alert('¡El usuario no puede ir vacío o llevar caracteres especiales!');
                            window.location = 'register';
                        </script>";
                    }
                }else {
                    echo "<script>
                            alert('¡El usuario ya existe!');
                            window.location = 'register';
                        </script>";
                }

                
            }
        }
    }