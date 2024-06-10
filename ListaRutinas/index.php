<!doctype html>
<html lang="en">

<head>
    <title>Lee Imagen</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php
include_once "basedatos.php"; // Corrección del nombre del archivo
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
                            <p class="card-text">Descripción de la imagen.</p>
                            <a href="borrar_imagen.php?id=<?php echo $id;?>" class="btn btn-danger">Borrar</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
                        <div class="card-footer"> <!-- Movimos el cierre de la tarjeta dentro del bucle while -->
                        <a href="cargarrutinas.php" class="btn btn-primary">Cargar Rutinas</a>
                    </div>
</div>
</body>

</html>