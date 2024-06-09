<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $query = "UPDATE empleado SET nombre=?, apellido=? WHERE dni=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('ssi', $nombre, $apellido, $dni); 

    if ($stmt->execute()) {
        echo "Empleado actualizado con éxito";
    } else {
        echo "Error al actualizar el empleado";
    }

    $stmt->close();
    $conexion->close();
}
?>
