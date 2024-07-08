<?php
session_start();

// Verificar si la sesión de usuario está activa
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Subir y Mostrar Imágenes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/cargarrutina.css">

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">SSGYM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CLIENTE
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_cliente.php">AGREGAR CLIENTE</a></li>
                            <li><a class="dropdown-item" href="registro_clientes.php">REGISTRO CLIENTES</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_cliente.php">ASISTENCIA CLIENTES</a></li>
                            <li><a class="dropdown-item" href="listaclientes.php">LISTA DE CLIENTES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        EMPLEADO
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_empleado.php">AGREGAR EMPLEADO</a></li>
                            <li><a class="dropdown-item" href="registro_empleados.php">REGISTRO EMPLEADOS</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_empleado.php">ASISTENCIA EMPLEADOS</a></li>
                            <li><a class="dropdown-item" href="listaclientes.php">LISTA DE CLIENTES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        RUTINAS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cargar_rutinas.php">AGREGAR RUTINA</a></li>
                            <li><a class="dropdown-item" href="rutinas.php">VER RUTINAS</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../controlador/controlador_cierresesion.php">CERRAR SESIÓN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Subir y Mostrar Imágenes</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Subir Imagen</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="imagen">Seleccionar Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                    <button type="submit" class="btn btn-primary" name="subir">Subir</button>
                    <a href="rutinas.php" class="btn btn-info">Volver a Rutinas</a>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Imágenes Subidas</h3>
                <div class="row">
                    <?php
                    // Procesar el formulario y guardar la imagen en la base de datos
                    include_once "../modelo/basedatos.php";
                    if(isset($_POST['subir'])) {
                        $nombre = $_POST['nombre'];
                        $imagen_temp = $_FILES['imagen']['tmp_name'];
                        $imagen_contenido = file_get_contents($imagen_temp);
                        $imagen_tipo = $_FILES['imagen']['type'];

                        // Conexión a la base de datos
                        $con = mysqli_connect($host, $username, $pass, $database);

                        // Preparar la consulta
                        $query = "INSERT INTO images (nombre, tipo, imagen) VALUES (?, ?, ?)";
                        $stmt = mysqli_prepare($con, $query);

                        // Vincular los parámetros
                        mysqli_stmt_bind_param($stmt, 'sss', $nombre, $imagen_tipo, $imagen_contenido);

                        // Ejecutar la consulta
                        mysqli_stmt_execute($stmt);

                        // Cerrar la conexión y liberar recursos
                        mysqli_stmt_close($stmt);
                        mysqli_close($con);
                    }

                    // Mostrar imágenes almacenadas en la base de datos
                    $con = mysqli_connect($host, $username, $pass, $database);
                    $query = "SELECT nombre, tipo, imagen FROM images";
                    $res = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $nombre = $row['nombre'];
                        $tipo = $row['tipo'];
                        $imagenBase64 = base64_encode($row['imagen']);
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card" style="width: 9rem;">
                                <img src="data:<?php echo $tipo; ?>;base64,<?php echo $imagenBase64; ?>" class="card-img-top" alt="<?php echo $nombre; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $nombre; ?></h5>
                                    <p class="card-text">Descripción de la imagen.</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>