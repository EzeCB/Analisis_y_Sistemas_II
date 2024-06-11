<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/menuempleadoestilo.css" />
    <style>
        .mensaje {
            display: none;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .mensaje.exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
        <h2 id="fecha"></h2>
        <p>Ingrese su DNI</p>
        <form id="form-asistencia">
            <input type="text" class="dni" placeholder="DNI del empleado" name="txtdni" required>
            <br><br>
            <button type="button" class="entrada" onclick="registrarAsistencia('entrada')">Entrada</button>
            <button type="button" class="salida" onclick="registrarAsistencia('salida')">Salida</button>
        </form>
        <p id="mensaje" class="mensaje"></p>

    <a href="../index.html" class="volver">Volver</a>

    </div>

    <script>
        function actualizarFecha() {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString("es-ES", { timeZone: "America/Argentina/Buenos_Aires" });
            document.getElementById("fecha").textContent = fechaHora;
        }

        setInterval(actualizarFecha, 1000);
        actualizarFecha(); // Llamar a la función inmediatamente para mostrar la fecha al instante

        function registrarAsistencia(tipo) {
            let formData = $('#form-asistencia').serialize() + '&tipo=' + tipo;

            $.ajax({
                url: '../controlador/controlador_registrar_entrada_salida_empleado.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    mostrarMensaje('La ' + tipo + ' se registró correctamente.', 'exito');
                    $('#form-asistencia')[0].reset(); // Limpiar el formulario después de enviar
                    setTimeout(function() {
                        window.location.href = '../index.html'; // Redirigir después de 2 segundos
                    }, 2000); // Espera 2 segundos antes de redirigir
                },
                error: function(xhr, status, error) {
                    let response = JSON.parse(xhr.responseText);
                    mostrarMensaje(response.message, 'error');
                }
            });
        }

        function mostrarMensaje(mensaje, tipo) {
            const mensajeElemento = document.getElementById('mensaje');
            mensajeElemento.textContent = mensaje;
            mensajeElemento.className = 'mensaje ' + tipo;
            mensajeElemento.style.display = 'block';
        }
    </script>
</body>
</html>
