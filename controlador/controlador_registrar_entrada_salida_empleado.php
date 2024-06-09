<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include "../modelo/conexion.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['txtdni'];
    $tipo = $_POST['tipo'];
    $datetime = date('Y-m-d H:i:s'); // Captura la fecha y hora actuales

    // Busca el ID del empleado a partir del DNI
    $query = "SELECT id_empleado FROM empleado WHERE dni = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_empleado = $row['id_empleado'];

        if ($tipo == 'entrada') {
            // Inserta un nuevo registro de entrada
            $query = "INSERT INTO entrada_salida_empleado (id_empleado, entrada) VALUES (?, ?)";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("is", $id_empleado, $datetime);
        } else if ($tipo == 'salida') {
            // Actualiza la salida del último registro de entrada del día
            $query = "UPDATE entrada_salida_empleado SET salida = ? WHERE id_empleado = ? AND DATE(entrada) = CURDATE() ORDER BY entrada DESC LIMIT 1";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("si", $datetime, $id_empleado);
        }

        if ($stmt->execute()) {
            echo json_encode(['message' => 'La ' . $tipo . ' se registró correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Hubo un error al registrar la ' . $tipo . ': ' . $stmt->error]);
        }
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'No se encontró un empleado con el DNI proporcionado.']);
    }

    $stmt->close();
    $conexion->close();
}
?>
