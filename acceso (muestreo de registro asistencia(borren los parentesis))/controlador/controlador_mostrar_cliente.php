<?php
include "../modelo/conexion.php";

// Consulta para obtener los registros de asistencia
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
    echo "<tr><td colspan='3'>No hay registros de asistencia.</td></tr>";
}
?>
