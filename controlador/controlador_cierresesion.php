<?php
session_start(); // Iniciar sesión si no está iniciada

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir de vuelta al inicio de sesión
header("Location: ../gym/login.php");
exit();
?>
