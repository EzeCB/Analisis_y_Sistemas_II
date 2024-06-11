<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../css/registrousuarioestilo.css" />
</head>
<body>
    <div class="container">
        <h1>Registro de Usuario</h1>

        <form id="registroForm">
        <label for="txtUsuario">Usuario:</label><br>
        <input type="text" id="txtUsuario" name="usuario" required><br><br>

        <label for="txtcontraseña">Contraseña:</label><br>
        <input type="password" id="txtcontraseña" name="contraseña" required><br><br>

        <label for="txtDNI">DNI:</label><br>
        <input type="text" id="txtDNI" name="dni" readonly><br><br>

        <label for="txtNombre">Nombre:</label><br>
        <input type="text" id="txtNombre" name="nombre" readonly><br><br>

        <label for="txtApellido">Apellido:</label><br>
        <input type="text" id="txtApellido" name="apellido" readonly><br><br>

        <label for="selectEmpleado">Empleado:</label><br>
        <select id="selectEmpleado" name="id_empleado" required>
            <option value="">Seleccionar...</option>
            <?php
            include "../modelo/conexion.php";

            $query = "SELECT id_empleado, nombre, apellido, dni FROM empleado";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_empleado'] . "' data-dni='" . $row['dni'] . "' data-nombre='" . htmlspecialchars($row['nombre']) . "' data-apellido='" . htmlspecialchars($row['apellido']) . "'>" . htmlspecialchars($row['nombre']) . " " . htmlspecialchars($row['apellido']) . "</option>";
                }
            }
            ?>
        </select><br><br>

        <button type="submit">Registrarse</button>
        </form>

        <a href="login.php">Volver</a>

        <div id="mensaje"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#selectEmpleado').change(function() {
                var selectedOption = $(this).find('option:selected');
                var dni = selectedOption.data('dni');
                var nombre = selectedOption.data('nombre');
                var apellido = selectedOption.data('apellido');

                $('#txtDNI').val(dni);
                $('#txtNombre').val(nombre);
                $('#txtApellido').val(apellido);
            });

            $('#registroForm').submit(function(event) {
                event.preventDefault();

                var usuario = $('#txtUsuario').val();
                var contraseña = $('#txtcontraseña').val();
                var idEmpleado = $('#selectEmpleado').val();

                $.ajax({
                    url: '../controlador/controlador_registrar_usuario.php', // Script PHP para registrar usuario
                    type: 'POST',
                    data: {
                        usuario: usuario,
                        contraseña: contraseña,
                        id_empleado: idEmpleado
                    },
                    success: function(respuesta) {
                        $('#mensaje').html('<p style="color: green;">' + respuesta + '</p>');
                        $('#registroForm')[0].reset();
                    },
                    error: function() {
                        $('#mensaje').html('<p style="color: red;">Error al registrar el usuario.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
