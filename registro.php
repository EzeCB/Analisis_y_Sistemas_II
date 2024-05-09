<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/estiloregistro.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="Formulario">
            <h2 class="titutlo">Registrar</h2>
            <?php
            
                include("modelo/conexion_registro.php");
                include("controlador/controlador_registro.php");

            ?>
            <div class="padre">
                <div class="nombre">
                    <label for="">Nombres</label>
                    <input type="text" name="nombre">
                </div>
                <div class="apellido">
                    <label for="">Apellidos</label>
                    <input type="text" name="apellido">
                </div>
                <div class="usuario">
                    <label for="">Usuario</label>
                    <input type="text" name="usuario">
                </div>
                <div class="password">
                    <label for="">Contraseña</label>
                    <input type="password" name="password">
                </div>
                <div class="cuenta">
                    <input class="boton" type="submit" value="Registrar" name="registro">
                    <a href="login.php">Regresar</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>