<?php 
session_start();
include("conexion.php");?>
<!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Content-Language" content="en">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>Inicio de Sesión - SAM</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
            <meta name="description" content="Login de Metas SA. de CV.">
            <!-- Disable tap highlight on IE -->
            <meta name="msapplication-tap-highlight" content="no">
            <link href="./main.8d288f825d8dffbbe55e.css" rel="stylesheet">
        </head>
    <body>
  
        <div class="app-container app-theme-white body-tabs-shadow">
            <div class="app-container">
                <div class="h-100">
                    <div class="h-100 no-gutters row">
                        <div class="d-none d-lg-block col-lg-4">
                            <div class="slider-light">
                                <div class="slick-slider">
                                    <div>
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-8">
                                            <div class="slide-img-bg" style="background-image: url('assets/images/originals/interconnected.jpg');"></div>
                                            <div class="slider-content"><h3>Perfecto Balance</h3>
                                                <p>Mantente en constante comunicación con el equipamiento de la empresa con la nueva herramienta SAM.</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                            <div class="slide-img-bg" style="background-image: url('assets/images/originals/abstract.jpg');"></div>
                                            <div class="slider-content"><h3>Intuitivo y fácil de usar</h3>
                                                <p>Puedes interactuar con la personalización del sistema a tu gusto con la comodidad de las funciones que tiene integradas SAM</p></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-sunny-morning" tabindex="-1">
                                            <div class="slide-img-bg" style="background-image: url('assets/images/originals/abstract2.jpg');"></div>
                                            <div class="slider-content"><h3>Comunicación constante</h3>
                                                <p>Mantente comunicado con toda tu área de trabajo.</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                                <div class="app-logo"></div>
                                <h4 class="mb-0">
                                    <span class="d-block">Bienvenido de Nuevo,</span>
                                    <span>Por favor ingresa tu número de usuario.</span>
                                </h4>
                                <h6 class="mt-3">No tienes cuenta? <a href="javascript:void(0);" class="text-primary">Comunícate con el área de Sistemas</a></h6>
                                <div class="divider row"></div>
                                <div>
                                <?php 
                                    extract($_POST, EXTR_PREFIX_ALL, '');
                                    if(isset($_email))
                                    { 
                                        // echo $_email;
                                        $objUsuario='';
                                        $conexion=new Conexion();
                                        $conexion->conectar();
                                        $sql="SELECT cve, Nombre +' '+Apellidos, password,Depto from Usuarios WHERE cve= '$_email'";
                                        $conexion->ejecutaQuery($sql);
                                         if($conexion->getNum()>0)
                                         {
                                            $objUsuario = $conexion->getArreglo();
                                          if ($objUsuario[2]!=$_password)
                                          {
                                            echo "Contraseña Incorrecta!";
                                          }
                                          else
                                          {
                                            $_SESSION['iduser']  = $objUsuario[0];
                                            $_SESSION['nombre']  = $objUsuario[1];
                                            $_SESSION['Depto']  = $objUsuario[3];
                                            echo "<<<_END
                                            <script>
                                            window.location.replace('index.php');
                                            </script>
                                            _END";
                                          }
                                        }
                                        else
                                        {
                                            echo "No existe la cuenta";
                                         }

                                   }
                                   
                                    ?>
                                    <form class="" action="login.php" method="post">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail" class="">Número de Usuario</label>
                                                    <input name="email" id="exampleEmail" placeholder="N° Usuario..." class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="examplePassword" class="">Contraseña</label>
                                                    <input name="password" id="examplePassword" placeholder="Ingresa tu contraseña..." type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="position-relative form-check">
                                            <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                            <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                                        </div> -->
                                        <div class="divider row"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="ml-auto"><a href="javascript:void(0);" class="btn-lg btn btn-link">Recuperar Contraseña</a>
                                                <input type="submit" class="btn btn-primary btn-lg" value="Inicia Sesión"></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="./assets/scripts/main.8d288f825d8dffbbe55e.js"></script>
    </body>
</html>
