<?php
include "../modelo/conexion.php";

// Consulta para obtener los registros de asistencia
$query = "SELECT id_asistencia, id_cliente, entrada FROM entrada_cliente";
$result = $conexion->query($query);

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Itera sobre los resultados y muestra cada fila en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id_asistencia']) . "</td>";
        echo "<td>" . htmlspecialchars($row['id_cliente']) . "</td>";
        echo "<td>" . htmlspecialchars($row['entrada']) . "</td>";
        echo "</tr>";
    }
} else {
    // Si no hay registros, muestra un mensaje en la tabla
    echo "<tr><td colspan='3'>No hay registros de asistencia.</td></tr>";
}
?>
