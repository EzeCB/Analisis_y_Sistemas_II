<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Inicio de sesión</title>
   <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
   <div class="container">
      <div class="login-content">
         <form method="post" action="">
            <h2 class="title">BIENVENIDO</h2>
            <?php
               include "modelo/conexion.php";
               include "controlador/controlador_login.php";
            ?>
            <div class="input-div one">
               <div class="div">
                  <h5>Usuario</h5>
                  <input id="usuario" type="text" class="input" name="usuario">
               </div>
            </div>
            <div class="input-div pass">
               <div class="div">
                  <h5>Contraseña</h5>
                  <input type="password" id="input" class="input" name="password">
               </div>
            </div>

            <div class="text-center">
               <a class="font-italic isai5" href="registro.php">Registrarse</a>
            </div>
            <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
         </form>
      </div>
   </div>
   <script src="js/fontawesome.js"></script>
   <script src="js/main.js"></script>
   <script src="js/main2.js"></script>
   <script src="js/jquery.min.js"></script>
</body>

</html>