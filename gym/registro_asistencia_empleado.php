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
    <title>Registros de Asistencia</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/registroasistenciaempleadoestilo.css" />
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

        <h1>Registros de Asistencia</h1>

        <table border="1" class="table">
            <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../modelo/conexion.php";

                $query = "SELECT entrada_salida_empleado.id_empleado, empleado.dni, empleado.nombre, empleado.apellido, 
                        entrada_salida_empleado.entrada, entrada_salida_empleado.salida 
                        FROM entrada_salida_empleado 
                        INNER JOIN empleado ON entrada_salida_empleado.id_empleado = empleado.id_empleado";
                $result = $conexion->query($query);

                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Itera sobre los resultados y muestra cada fila en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['entrada']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['salida']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Si no hay registros, muestra un mensaje en la tabla
                    echo "<tr><td colspan='5'>No hay registros de asistencia.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="../index.php">Inicio</a>

    </div>
    
    <script src="../js/jquery_min.js"></script>
</body>
</html>
