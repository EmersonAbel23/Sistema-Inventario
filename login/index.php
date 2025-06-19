<?php 
include("modelo/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link rel="shortcut icon" href="img/logotipoMinired.JPG" type="image/x-icon">
   <title>Mini - Red</title>
</head>

<body>


   <img class="wave" src="img/wave.png">
   <div class="container">
      <div class="img">
         <img src="img/avatar2.png">
      </div>
      <div class="login-content">
         <form method="post" action="">
            <img src="img/avatar.svg">
            <h2 class="title">BIENVENIDO</h2>
   

            <?php 
            include("controlador/controlador_login.php");
            ?>

            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" pattern="[A-Za-z0-9_-]{1,15}" required class="input" name="usuario">
               </div>
            </div>
            

            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="input" pattern="^(?:(?!'or'1'='1').)*$" required class="input" name="password">
               </div>
            </div>

            <div class="view">
               <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
            </div>

            <div class="text-center">
               <!-- Modal para recuperación -->
               <a class="font-italic isai5" href="#" data-toggle="modal" data-target="#recuperarModal">Olvidé mi contraseña</a><br>
               <!-- Modal de registro -->
               <a class="font-italic isai5" href="#" data-toggle="modal" data-target="#registroModal">Registrarse</a>
            </div>

            <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
         </form>
      </div>
   </div>

   <!-- Modal de Registro -->
   <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form method="POST" action="controlador/controlador_registro.php" class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="registroModalLabel">Registro de Nuevo Usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            
            <div class="modal-body">
               
                  <div class="form-group">
                     <label for="nombre">Nombre</label>
                     <input type="text" class="form-control" name="nombre" required>
                  </div>

                  <div class="form-group">
                     <label for="apellido">Apellido</label>
                     <input type="text" class="form-control" name="apellido" required>
                  </div>

               <div class="form-group">
                  <label for="correo">Correo electrónico</label>
                  <input type="email" class="form-control" name="correo" required>
               </div>

               <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" class="form-control" name="password" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
         </form>
      </div>
   </div>


   <!-- Modal de Recuperación de Contraseña -->
   <div class="modal fade" id="recuperarModal" tabindex="-1" role="dialog" aria-labelledby="recuperarModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form method="POST" action="controlador/enviar_token.php" class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="recuperarModalLabel">Recuperar Contraseña</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="correo">Ingrese su correo electrónico</label>
                  <input type="email" class="form-control" name="correo_recuperar" required>
               </div>
               <small class="form-text text-muted">Te enviaremos un enlace para restablecer tu contraseña.</small>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
         </form>
      </div>
   </div>

   <!-- Scripts -->
   <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.bundle.js"></script>
   <script src="js/fontawesome.js"></script>
   <script src="js/main.js"></script>
   <script src="js/main2.js"></script>
</body>

</html>
