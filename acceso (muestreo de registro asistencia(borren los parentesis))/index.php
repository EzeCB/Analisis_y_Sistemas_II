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
</head>
<body>
    <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
    <h2 id="fecha"></h2>

    <div class="container">
        <a href="gym/registro_asistencia_cliente.php">Registro Asistencia Cliente</a>
        <a href="gym/registro_clientes.php">Registro Cliente</a>
        <p>Ingrese su DNI</p>
        <form action="" method="POST">
            <input type="text" placeholder="DNI del empleado" name="txtdni" required>
            <button class="entrada" type="submit" name="btnentrada" value="entrada">ENTRADA</button>
        </form>
    </div>

    <script>
        setInterval(() => {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString("es-ES");
            document.getElementById("fecha").textContent = fechaHora;
        }, 1000);
    </script>

    <?php include "controlador/controlador_registrar_asistencia_cliente.php"; ?>
</body>
</html>
