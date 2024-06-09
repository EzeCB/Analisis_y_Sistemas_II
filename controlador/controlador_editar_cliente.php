<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cuota = $_POST['cuota'];

    $query = "UPDATE cliente SET nombre=?, apellido=?, cuota=? WHERE dni=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sssi', $nombre, $apellido, $cuota, $dni);

    if ($stmt->execute()) {
        echo "Cliente actualizado con éxito";
    } else {
        echo "Error al actualizar el cliente";
    }
}
?>
