<?php
// Archivo editar_recibo.php
// Sirve para poder editar un recibo seleccionda

// Se incluye la conexion a la base de datos
include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Receta</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <section class="form">
        <?php

        // Comprueba si el formulario fue enviado (botón "enviar" presionado)
        if (isset($_POST['enviar'])) {
            include("../conexion.php");

            // Se recuperan los datos que estan dentro de los input
            $id_recibo = $_POST['id_recibo'];
            $costo = $_POST['costo'];
            $fecha_generacion = $_POST['fecha_generacion'];
            $hora_generacion = $_POST['hora_generacion'];

            // Se realiza la actualizacion de los datos
            $sql = "UPDATE recibo set costo = '$costo', fecha_generacion= '$fecha_generacion',hora_generacion='$hora_generacion' 
        where id_recibo =" . $id_recibo;
            $resultado = mysqli_query($conexion, $sql);

            // Si se realiza la actualización correctamente se envia una alerta
            // de que los datos fueron gusardados
            if ($resultado) {
                echo " <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_recibos.php');
            </script>";
                // De lo contrario, si no se realiza la actualización correctamente 
                //se envia una alerta de que los datos fueron guardados
            } else {
                echo " <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_citas.php');
            </script>";
            }
            // Se cierra la conexión a la base de datos
            mysqli_close($conexion);
        } else { //Recuperar los datos y mostrarlos en los input
        
            // Se recuperan los datos que se van a actualizar
            $id_recibo = $_GET['id_recibo'];

            // Se crea a consultasa y se ejecuta para obtener los valores y almacenarlos
            $sql = "select * from v_recibo where id_recibo= '" . $id_recibo . "'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);
            date_default_timezone_set('America/Mexico_City');

           
            $id_recibo = $fila["id_recibo"];
            $fecha_generacion = $fila["fecha_generacion"];
            $hora_generacion = $fila["hora_generacion"];
            $paciente = $fila["paciente"];
            $telefono_paciente = $fila["telefono_paciente"];
            $nombre_suc = $fila["nombre_suc"];
            $direccion_suc = $fila["direccion_suc"];
            $telefono_suc = $fila["telefono_suc"];
            $costo = $fila["costo"];

            // Se cierra la conexión a la base de datos
            mysqli_close($conexion);
        }
        ?>
        <!-- Se crea el form con los datos obtenidos anteriormente
            para poder actualizarlos -->
        <form action="" method="POST">
            <label></label>

            <h2>Sucursal</h2>
            <input type="hidden" name="id_recibo" value="<?php echo $id_recibo; ?>" readonly>
            <label>Sucursal:</label>
            <input type="text" name="nombre_suc" value="<?php echo $nombre_suc; ?>" readonly>
            <label>Dirrección:</label>
            <input type="text" name="direccion_suc" value="<?php echo $direccion_suc; ?>" readonly>
            <label>Telefono:</label>
            <input type="text" name="telefono_suc" value="<?php echo $telefono_suc; ?>" readonly>

            <h1>RECETA MÉDICA</h1>
            <h2>Datos de la Cita</h2>
            <label>Paciente:</label>
            <input type="text" name="paciente" value="<?php echo $paciente; ?>" readonly>
            <label>Telefono:</label>
            <input type="text" name="telefono_paciente" value="<?php echo $telefono_paciente; ?>" readonly>
            <label>Hora:</label>
            <input type="text" name="hora_generacion" value="<?php echo $hora_generacion; ?>" readonly>
            <label>Fecha:</label>
            <input type="text" name="fecha_generacion" value="<?php echo $fecha_generacion; ?>" readonly>
            <h2>Cuerpo del Recibo</h2>
            <label for="">Se pagaran: </label>
            <input type="text" name="costo" placeholder="Costo" value="<?php echo $costo; ?>" required>

            <!-- Botones para regresar al menú anterior y enviar el formulario para actualizar -->
            <button type="submit" name="enviar">Guardar</button>
            <a href="index_recibos.php">Regresar</a>
    </section>
</body>

</html>