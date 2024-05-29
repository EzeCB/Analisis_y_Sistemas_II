<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Asistencia</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <h1>Registros de Clientes</h1>

    <table border="1">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cuota</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../modelo/conexion.php";

            $query = "SELECT dni, nombre, apellido, cuota FROM cliente";
            $result = $conexion->query($query);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Itera sobre los resultados y muestra cada fila en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['dni']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cuota']) . "</td>";
                    echo "</tr>";
                }
            } else {
                // Si no hay registros, muestra un mensaje en la tabla
                echo "<tr>No hay registros de asistencia.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="../index.php">Inicio</a>

    <script src="../js/jquery_min.js"></script>

</body>
</html>
