<?php
session_start();
if (empty($_SESSION["id"])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="text-white bg-success p-2">
		<?php
			echo "Bienvenido/a --- ". $_SESSION["nombre"]." ". $_SESSION["apellido"];
		?>
	</div>

	<a href="controlador/controlador_cerrar_sesion.php">Salir</a>

	<h1>Pagina De Inicio</h1>

	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>