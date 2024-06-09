<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];

    // Obtener el id_cliente basado en el dni
    $query = "SELECT id_cliente FROM cliente WHERE dni = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_cliente = $row['id_cliente'];

        // Iniciar una transacción
        $conexion->begin_transaction();

        try {
            // Eliminar los registros relacionados en entrada_cliente
            $query = "DELETE FROM entrada_cliente WHERE id_cliente = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $id_cliente);
            $stmt->execute();

            // Ahora eliminar el registro en cliente
            $query = "DELETE FROM cliente WHERE dni = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('s', $dni);
            $stmt->execute();

            // Confirmar la transacción
            $conexion->commit();
            echo "Cliente eliminado con éxito";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            echo "Error al eliminar el cliente: " . $e->getMessage();
        }
    } else {
        echo "Cliente no encontrado";
    }
}
?>
