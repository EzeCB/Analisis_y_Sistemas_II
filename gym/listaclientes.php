<?php
session_start();

// Verificar si la sesión de usuario está activa
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssgym";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

$query = "SELECT cl.id_cliente, cl.nombre AS nombre_cliente, en.id_empleado, en.nombre AS nombre_empleado 
          FROM cliente cl
          LEFT JOIN asignaciones a ON cl.id_cliente = a.id_cliente
          LEFT JOIN empleado en ON a.id_empleado = en.id_empleado";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/inicioestilos.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SSGYM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inicio.php">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CLIENTE</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_cliente.php">AGREGAR CLIENTE</a></li>
                            <li><a class="dropdown-item" href="registro_clientes.php">REGISTRO CLIENTES</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_cliente.php">ASISTENCIA CLIENTES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">EMPLEADO</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="agregar_empleado.php">AGREGAR EMPLEADO</a></li>
                            <li><a class="dropdown-item" href="registro_empleados.php">REGISTRO EMPLEADOS</a></li>
                            <li><a class="dropdown-item" href="registro_asistencia_empleado.php">ASISTENCIA EMPLEADOS</a></li>
                            <li><a class="dropdown-item" href="lista_de_clientes.php">LISTA DE CLIENTES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">RUTINAS</a>
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
        <?php if (count($clientes) > 0): ?>
            <h2>Listado de Clientes por Profesor</h2>
            <ul class="list-group">
                <?php
                $currentEmpleado = null;
                foreach ($clientes as $cliente):
                    if ($currentEmpleado !== $cliente['nombre_empleado']): ?>
                        <?php if ($currentEmpleado !== null): ?>
                            </ul>
                        <?php endif; ?>
                        <li class="list-group-item active"><?php echo $cliente['nombre_empleado']; ?></li>
                        <ul class="list-group">
                        <?php $currentEmpleado = $cliente['nombre_empleado']; ?>
                    <?php endif; ?>
                    <li class="list-group-item"><?php echo $cliente['nombre_cliente']; ?></li>
                <?php endforeach; ?>
                </ul>
            </ul>
        <?php else: ?>
            <p>No se encontraron clientes registrados en el gimnasio.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
