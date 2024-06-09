<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $query = "INSERT INTO empleado (dni, nombre, apellido) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sss', $dni, $nombre, $apellido);

    if ($stmt->execute()) {
        echo "Cliente agregado con éxito";
    } else {
        echo "Error al agregar el cliente: " . $stmt->error;
    }

    // Redirige a la página principal después de la inserción
    header("Location: ../gym/registro_empleados.php");
    exit();
}
?>
