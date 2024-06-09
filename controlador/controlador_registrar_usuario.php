<?php
include "../modelo/conexion.php"; // Asegúrate de que el archivo de conexión tenga el nombre y la ruta correctos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $idEmpleado = $_POST['id_empleado'];

    // Preparar la consulta SQL para evitar inyecciones SQL
    $query = $conexion->prepare("INSERT INTO usuario (usuario, contraseña, id_empleado) VALUES (?, ?, ?)");
    $query->bind_param("ssi", $usuario, $contraseña, $idEmpleado);

    // Ejecutar la consulta y verificar si se ejecutó correctamente
    if ($query->execute()) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error al registrar el usuario: " . $query->error;
    }

    // Cerrar la consulta y la conexión
    $query->close();
    $conexion->close();
}
?>
