<?php
include "../modelo/conexion.php";
header('Content-Type: application/json');

date_default_timezone_set('America/Argentina/Buenos_Aires');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["txtdni"]) && !empty($_POST["btnentrada"])) {
        $dni = $_POST["txtdni"];
        $id_asistencia = $_POST["btnentrada"];
        
        // Preparar y ejecutar la consulta para verificar el DNI
        $stmt = $conexion->prepare("SELECT COUNT(*) AS total, id_cliente FROM cliente WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data['total'] > 0) {
            $id_cliente = $data['id_cliente'];
            $fecha = date("Y-m-d H:i:s");

            // Preparar y ejecutar la inserción de la entrada/salida del cliente
            $stmt = $conexion->prepare("INSERT INTO entrada_cliente (id_cliente, id_asistencia, entrada) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_cliente, $id_asistencia, $fecha);
            $sql = $stmt->execute();

            if ($sql) {
                // Respuesta de éxito
                echo json_encode(['message' => '¡Entrada registrada correctamente!', 'type' => 'exito']);
            } else {
                // Respuesta de error
                http_response_code(500);
                echo json_encode(['message' => 'Error al registrar entrada', 'type' => 'error']);
            }
        } else {
            // Respuesta de DNI incorrecto
            http_response_code(404);
            echo json_encode(['message' => 'El DNI ingresado no existe', 'type' => 'error']);
        }
    } else {
        // Respuesta de error si el DNI no se ingresó
        http_response_code(400);
        echo json_encode(['message' => 'Ingrese el DNI', 'type' => 'error']);
    }
}
?>
