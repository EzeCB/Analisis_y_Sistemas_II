<?php
session_start();

// Verificar si la sesión de usuario está activa
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Empleados</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/registroempleadoestilo.css" />

</head>
<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">SSGYM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CLIENTE
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_cliente.php">AGREGAR CLIENTE</a></li>
                            <li><a class="dropdown-item" href="registro_clientes.php">REGISTRO CLIENTES</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_cliente.php">ASISTENCIA CLIENTES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        EMPLEADO
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_empleado.php">AGREGAR EMPLEADO</a></li>
                            <li><a class="dropdown-item" href="registro_empleados.php">REGISTRO EMPLEADOS</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_empleado.php">ASISTENCIA EMPLEADOS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        RUTINAS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cargar_rutinas.php">AGREGAR RUTINA</a></li>
                            <li><a class="dropdown-item" href="rutinas.php">VER RUTINAS</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../controlador/controlador_cierresesion.php">CERRAR SESIÓN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <h1>Registros de Empleados</h1>
        <a href="agregar_empleado.php">Agregar Nuevo Empleado</a>
        <table border="1" class="table">
            <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../modelo/conexion.php";

                $query = "SELECT dni, nombre, apellido FROM empleado";
                $result = $conexion->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='dni'>" . htmlspecialchars($row['dni']) . "</td>";
                        echo "<td class='nombre'>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td class='apellido'>" . htmlspecialchars($row['apellido']) . "</td>";
                        echo "<td><button onclick='editarRegistro(this)'>Editar</button><button onclick='eliminarRegistro(\"" . htmlspecialchars($row['dni']) . "\")'>Eliminar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay registros de asistencia.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <form id="editForm" style="display:none;">
            <h2>Editar Empleado</h2>
            <input type="hidden" id="editDni" name="dni">
            <label for="editNombre">Nombre:</label>
            <input type="text" id="editNombre" name="nombre"><br><br>
            <label for="editApellido">Apellido:</label>
            <input type="text" id="editApellido" name="apellido"><br><br>
            <button type="button" onclick="location.href='registro_empleados.php'">Cancelar</button>
            <button type="button" onclick="guardarCambios()">Guardar</button>
        </form>

        <a href="../index.php">Inicio</a>
    
    </div>

    <script>
        function editarRegistro(button) {
            var row = $(button).closest('tr');
            var dni = row.find('.dni').text();
            var nombre = row.find('.nombre').text();
            var apellido = row.find('.apellido').text();

            $('#editDni').val(dni);
            $('#editNombre').val(nombre);
            $('#editApellido').val(apellido);

            $('#editForm').show();
        }

        function guardarCambios() {
            var dni = $('#editDni').val();
            var nombre = $('#editNombre').val();
            var apellido = $('#editApellido').val();

            $.ajax({
                url: '../controlador/controlador_editar_empleado.php',
                type: 'POST',
                data: {
                    dni: dni,
                    nombre: nombre,
                    apellido: apellido
                },
                success: function(response) {
                    alert(response);
                    location.reload(); // Recargar la página después de actualizar
                },
                error: function() {
                    alert('Error al actualizar el empleado');
                }
            });
        }

        function eliminarRegistro(dni) {
            if (confirm('¿Está seguro de que desea eliminar este registro?')) {
                $.ajax({
                    url: '../controlador/controlador_eliminar_empleado.php',
                    type: 'POST',
                    data: { dni: dni },
                    success: function(response) {
                        alert(response);
                        location.reload(); // Recargar la página después de eliminar
                    },
                    error: function() {
                        alert('Error al eliminar el empleado');
                    }
                });
            }
        }
    </script>
</body>
</html>
