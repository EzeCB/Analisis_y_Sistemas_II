<?php
session_start(); // Iniciar sesión si no está iniciada

include "../modelo/conexion.php"; // Incluir archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Consulta para obtener el usuario de la base de datos
    $query = "SELECT id_usuario, usuario, contraseña, id_empleado FROM usuario WHERE usuario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Obtener el resultado como arreglo asociativo
        $row = $result->fetch_assoc();

        // Verificar si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
        if (password_verify($contraseña, $row['contraseña'])) {
            // Iniciar sesión y almacenar datos de usuario en variables de sesión si el inicio de sesión es exitoso
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['id_empleado'] = $row['id_empleado'];

            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "message" => "La contraseña proporcionada es incorrecta."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "El usuario proporcionado no existe."));
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
}
?>
