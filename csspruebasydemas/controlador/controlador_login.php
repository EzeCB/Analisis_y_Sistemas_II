<?php

session_start();

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];
        
        // Obtener la contraseña encriptada de la base de datos
        $sql=$conexion->query("SELECT * FROM usuario WHERE usuario='$usuario'");
        if ($datos=$sql->fetch_object()) {
            $contrasena_encriptada = $datos->password;
            
            // Verificar si la contraseña proporcionada coincide con la contraseña encriptada almacenada
            if (password_verify($password, $contrasena_encriptada)) {
                $_SESSION["id"]=$datos->id;
                $_SESSION["nombre"]=$datos->nombres;
                $_SESSION["apellido"]=$datos->apellidos;
                
                header("location: inicio.php");
            } else {
                echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>No existe cuenta con estos datos</div>";
        }
    } else {
        echo "Campos vacíos";
    }
}

?>
