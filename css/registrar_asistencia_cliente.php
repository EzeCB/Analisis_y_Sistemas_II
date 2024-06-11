<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/menuclienteestilo.css" />
        
</head>
<body>
    <div class="container">
        <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
        <h2 id="fecha"></h2>
        <p>Ingrese su DNI</p>
        <form id="form-asistencia">
            <input type="text" class="dni" placeholder="DNI del Cliente" name="txtdni" required>
            <br><br><br>
            <button type="button" class="entrada" onclick="registrarAsistencia('entrada')">ENTRADA</button>
        </form>

    <a href="../index.html" class="volver">Volver</a>

    </div>

    <script>
        function actualizarFechaHora() {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString("es-ES", { timeZone: "America/Argentina/Buenos_Aires" });
            document.getElementById("fecha").textContent = fechaHora;
        }
        setInterval(actualizarFechaHora, 1000);
        actualizarFechaHora();

        function registrarAsistencia(tipo) {
            let formData = $('#form-asistencia').serialize() + '&btnentrada=' + tipo;

            $.ajax({
                url: '../controlador/controlador_registrar_asistencia_cliente.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    mostrarMensaje(response.message, 'exito');
                    $('#form-asistencia')[0].reset();
                    setTimeout(function() {
                        window.location.href = '../index.html';
                    }, 2000);
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    mostrarMensaje(response.message, 'error');
                }
            });
        }

        function mostrarMensaje(mensaje, tipo) {
            new PNotify({
                text: mensaje,
                type: tipo,
                styling: 'bootstrap3',
                addclass: tipo, // Esta clase se utiliza para aplicar los estilos personalizados
                delay: 2000,
                stack: {
                    dir1: 'down', // Dirección de apilamiento
                    dir2: 'right', // Sentido de apilamiento
                    firstpos1: 20, // Posición inicial vertical
                    spacing1: 20 // Espacio entre notificaciones
                }
            });
        }
    </script>
</body>
</html>
