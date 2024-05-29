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
    <h1>Registros de Asistencia</h1>

    <table border="1">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Cuota</th>
                <th>Entrada</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../modelo/conexion.php";

            $query = "SELECT entrada_cliente.id_cliente, cliente.cuota, cliente.dni, cliente.nombre, cliente.apellido, entrada_cliente.id_asistencia, entrada_cliente.entrada 
            FROM entrada_cliente 
            INNER JOIN cliente ON entrada_cliente.id_cliente = cliente.id_cliente";
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
                    echo "<td>" . htmlspecialchars($row['entrada']) . "</td>";
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
