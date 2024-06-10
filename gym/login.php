<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/loginestilos.css" />
</head>
<body>
    <div class="container">
        
        <h1>Inicio de Sesión</h1>

        <form id="loginForm">
            <label for="txtUsuario">Usuario:</label><br>
            <input type="text" id="txtUsuario" name="usuario" required><br><br>

            <label for="txtcontraseña">Contraseña:</label><br>
            <input type="password" id="txtcontraseña" name="contraseña" required><br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
    
        <a href="registrar_usuario.php">Registrarse</a>
        <a href="../index.html">Volver</a>
        <div id="mensaje"></div>
        
    </div>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();

                var usuario = $('#txtUsuario').val();
                var contraseña = $('#txtcontraseña').val();

                // Enviar los datos al controlador de inicio de sesión
                $.ajax({
                    url: '../controlador/controlador_login.php',
                    type: 'POST',
                    data: {
                        usuario: usuario,
                        contraseña: contraseña
                    },
                    dataType: 'json', // Esperar respuesta JSON desde el servidor
                    success: function(response) {
                        if (response.success) {
                            // Redirigir al usuario a la página después de iniciar sesiwón
                            window.location.href = 'inicio.php';
                        } else {
                            $('#mensaje').html('<p style="color: red;">' + response.message + '</p>');
                        }
                    },
                    error: function() {
                        $('#mensaje').html('<p style="color: red;">Error al iniciar sesión. Verifica tus credenciales.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
