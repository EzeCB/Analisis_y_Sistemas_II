<?php
include "modelo/conexion.php";

date_default_timezone_set('America/Argentina/Buenos_Aires');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["txtdni"]) && !empty($_POST["btnentrada"])) {
        $dni = $_POST["txtdni"];
        $id_asistencia = $_POST["btnentrada"];
        
        // Preparar y ejecutar la consulta para verificar el DNI
        $stmt = $conexion->prepare("SELECT COUNT(*) AS total, id_cliente FROM cliente WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data['total'] > 0) {
            $id_cliente = $data['id_cliente'];
            $fecha = date("Y-m-d H:i:s");

            // Preparar y ejecutar la inserción de la entrada/salida del cliente
            $stmt = $conexion->prepare("INSERT INTO entrada_cliente (id_cliente, id_asistencia, entrada) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id_cliente, $id_asistencia, $fecha);
            $sql = $stmt->execute();

            if ($sql) {
                echo "<script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'CORRECTO',
                            type: 'success',
                            text: 'Hola, BIENVENIDO',
                        });
                    });
                </script>";
            } else {
                echo "<script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'INCORRECTO',
                            type: 'error',
                            text: 'Error al registrar ENTRADA',
                        });
                    });
                </script>";
            }
        } else {
            echo "<script>
                $(function notificacion() {
                    new PNotify({
                        title: 'INCORRECTO',
                        type: 'error',
                        text: 'El DNI ingresado no existe',
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            $(function notificacion() {
                new PNotify({
                    title: 'INCORRECTO',
                    type: 'error',
                    text: 'Ingrese el DNI',
                });
            });
        </script>";
    }

    echo "<script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>";
}
?>
