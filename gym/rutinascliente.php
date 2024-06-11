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
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>

    <a href="../index.html" class="volver">Volver</a>

</body>

</html>