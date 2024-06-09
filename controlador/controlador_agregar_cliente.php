<?php
include "../modelo/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $cuota = $_POST['cuota'];

    $query = "INSERT INTO cliente (dni, nombre, apellido, cuota) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('ssss', $dni, $nombre, $apellido, $cuota);

    if ($stmt->execute()) {
        echo "Cliente agregado con éxito";
    } else {
        echo "Error al agregar el cliente: " . $stmt->error;
    }

    // Redirige a la página principal después de la inserción
    header("Location: ../gym/registro_clientes.php");
    exit();
}
?>
