<!doctype html>
<html lang="en">

<head>
    <title>Subir y Mostrar Imágenes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

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
                <a href="index.php" class="btn btn-info">Volver a Index</a>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Imágenes Subidas</h3>
            <div class="row">
                <?php
                // Procesar el formulario y guardar la imagen en la base de datos
                include_once "basedatos.php";
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
                        <div class="card" style="width: 18rem;">
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