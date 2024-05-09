<?php

if (!empty($_POST["registro"])) {
    if (empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["usuario"]) or empty($_POST["password"])) {
        echo '<div>Uno de los campos está vacío</div>';
    } else {
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];
        
        // Verificar si el usuario ya existe
        $sql_check = $conexion->query("SELECT COUNT(*) AS total FROM usuario WHERE usuario='$usuario'");
        $row = $sql_check->fetch_assoc();
        if ($row['total'] > 0) {
            echo '<div>El usuario ya existe</div>';
        } else {
            // Encriptar la contraseña
            $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar usuario con contraseña encriptada
            $sql=$conexion->query("INSERT INTO usuario (nombres, apellidos, usuario, password) VALUES ('$nombre', '$apellido', '$usuario', '$password_encriptada')");
            if ($sql==1) {
                echo "<div>Usuario Registrado Correctamente</div>";
            } else {
                echo "<div>Error al Registrar</div>";
            }
        }
    }
}

?>
