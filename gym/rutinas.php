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
    <title>Lee Imagen</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/rutinas.css">

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

<?php
include_once "../modelo/basedatos.php"; // Corrección del nombre del archivo
$con = mysqli_connect($host, $username, $pass, $database);
$query = "SELECT id, nombre, tipo, imagen FROM images;"; // Agregamos la selección del ID
$res = mysqli_query($con, $query);
?>

<div class="container">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id']; // Obtención del ID
            $nombre = $row['nombre'];
            $tipo = $row['tipo'];
            $imagenBase64 = base64_encode($row['imagen']);
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="data:<?php echo $tipo; ?>;base64,<?php echo $imagenBase64; ?>" class="card-img-top" alt="<?php echo $nombre; ?>">
                    <div class="card-body">
                            <h5 class="card-title"><?php echo $nombre; ?></h5>
                            <a href="../controlador/controlador_borrar_imagen.php?id=<?php echo $id;?>" class="btn btn-danger">Borrar</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
                        <div class="card-footer"> <!-- Movimos el cierre de la tarjeta dentro del bucle while -->
                        <a href="cargar_rutinas.php" class="btn btn-primary">Cargar Rutinas</a>
                    </div>
</div>
</body>

</html>