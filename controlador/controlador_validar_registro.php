<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $id_empleado = $_POST['id_empleado'];

    $query = "SELECT COUNT(*) AS count FROM empleado WHERE dni = ? AND id_empleado = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('si', $dni, $id_empleado);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $valid = ($row['count'] > 0) ? true : false;

    echo json_encode(['valid' => $valid]);

    $stmt->close();
    $conexion->close();
}
?>
