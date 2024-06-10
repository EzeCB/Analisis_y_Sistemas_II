<?php
include_once "../modelo/basedatos.php";

// Verificar si se ha enviado un ID de imagen para borrar
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    $con = mysqli_connect($host, $username, $pass, $database);

    // Preparar la consulta para eliminar la imagen
    $query = "DELETE FROM images WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, 'i', $id);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Cerrar la conexión y liberar recursos
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Redireccionar de vuelta a la página principal o a donde quieras después de borrar la imagen
    header("Location: ../gym/rutinas.php");
    exit();
} else {
    // Si no se ha enviado un ID de imagen, redireccionar de vuelta a la página principal con un mensaje de error
    header("Location: ../gym/rutinas.php?error=1");
    exit();
}
?>