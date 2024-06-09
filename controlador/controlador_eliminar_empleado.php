<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];

    // Obtener el id_empleado basado en el dni
    $query = "SELECT id_empleado FROM empleado WHERE dni = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_empleado = $row['id_empleado'];

        // Iniciar una transacción
        $conexion->begin_transaction();

        try {
            // Eliminar los registros relacionados en entrada_salida_empleado
            $query = "DELETE FROM entrada_salida_empleado WHERE id_empleado = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $id_empleado);
            $stmt->execute();

            // Eliminar el registro en la tabla usuario
            $query = "DELETE FROM usuario WHERE id_empleado = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $id_empleado);
            $stmt->execute();

            // Ahora eliminar el registro en empleado
            $query = "DELETE FROM empleado WHERE dni = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('s', $dni);
            $stmt->execute();

            // Confirmar la transacción
            $conexion->commit();
            echo "Empleado eliminado con éxito";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            echo "Error al eliminar al empleado: " . $e->getMessage();
        }
    } else {
        echo "Empleado no encontrado";
    }
}
?>
