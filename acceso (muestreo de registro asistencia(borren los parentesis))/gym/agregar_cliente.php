<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cliente</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // permitir solo números en el campo DNI
            $("#dni").on("input", function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            $("#registroForm").submit(function(event){
                event.preventDefault(); // Evita el envío del formulario

                var formData = $(this).serialize(); // Serializa los datos del formulario

                $.ajax({
                    url: "../controlador/controlador_insertar_cliente.php",
                    type: "POST",
                    data: formData,
                    success: function(response){
                        alert("Cliente agregado correctamente.");
                        window.opener.location.reload(); // Recarga la página principal
                        window.close(); // Cierra la ventana emergente
                    },
                    error: function(){
                        alert("Hubo un error al agregar el cliente.");
                    }
                });
            });
        });
    </script>
</head>
<body>
    <form id="registroForm">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="cuota">Cuota:</label>
        <input type="date" id="cuota" name="cuota" required><br>

        <button type="submit">Agregar Cliente</button>
    </form>
</body>
</html>
