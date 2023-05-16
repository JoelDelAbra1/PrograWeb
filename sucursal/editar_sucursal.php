<?php
// Archivo editar_sucurdal.php
// Sirve para poder editar una sucursal seleccionda

// Se incluye la conexion a la base de datos
include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <section class="form">
        <?php

        // Comprueba si el formulario fue enviado (botón "enviar" presionado)
        if (isset($_POST['enviar'])) {
            $id_sucursal = $_POST['id_sucursal'];
            $nombre_suc = $_POST['nombre_suc'];
            $direccion_suc = $_POST['direccion_suc'];
            $telefono_suc = $_POST['telefono_suc'];

            // Comprueba si faltan campos por llenas, si es asi se envia una alerta
            if (empty($_POST['nombre_suc']) || empty($_POST['direccion_suc']) || empty($_POST['telefono_suc'])) {
                echo " <script languaje = 'JavaScript'>
                    alert('ERROR: Faltaron Datos');
                    location.assign('index_sucursal.php');
                    </script>";

            } else {

                // De lo contrario se realiza la actualizacion de los datos
                $sql = "Update sucursal set direccion_suc = '$direccion_suc', nombre_suc = '$nombre_suc',
                telefono_suc = '$telefono_suc' where id_sucursal =" . $id_sucursal;
                $resultado = mysqli_query($conexion, $sql);

                // Si se realiza la actualización correctamente se envia una alerta
                // de que los datos fueron gusardados
                if ($resultado) {
                    echo " <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_sucursal.php');
            </script>";

                // De lo contrario, si no se realiza la actualización correctamente 
                //se envia una alerta de que los datos fueron guardados
                } else {
                    echo " <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_sucursal.php');
            </script>";
                }

                // Se cierra la conexión a la base de datos
                mysqli_close($conexion);
            }

        } else {

            // Se recuperan los datos que se van a actualizar
            $id_sucursal = $_GET['id_sucursal'];

            // Se crea a consulta sq y se ejecuta para obtener los valores y almacenarlos
            $sql = 'SELECT * FROM sucursal WHERE id_sucursal="' . $id_sucursal . '"';
            $resultado = mysqli_query($conexion, $sql);
            $fila = (mysqli_fetch_assoc($resultado));
            $id_sucursal = $fila['id_sucursal'];
            $nombre_suc = $fila["nombre_suc"];
            $telefono_suc = $fila["telefono_suc"];
            $direccion_suc = $fila["direccion_suc"];

            // Se cierra la conexión a la base de datos
            mysqli_close($conexion);

            ?>

            <!-- Se crea el form con los datos obtenidos anteriormente
            para poder actualizarlos -->
            <form action="" method="POST">
                <input type="hidden" name="id_sucursal" placeholder="Id Sucursal" value="<?php 
                    if (isset($id_sucursal))
                        echo $id_sucursal ?>" required>
                    <label for="">Nombre Sucursal</label>
                    <input type="text" name="nombre_suc" placeholder="Nombre Sucursal" value="<?php
                    if (isset($nombre_suc))
                        echo $nombre_suc ?>" required>
                    <label for="">Teléfono Sucursal</label>
                    <input type="tel" name="telefono_suc" placeholder="Teledono Sucursal" value="<?php
                    if (isset($telefono_suc))
                        echo $telefono_suc ?>" required>
                    <label for="">Direccion Sucursal</label>
                    <input type="text" name="direccion_suc" placeholder="Direccion sucursal" value="<?php
                    if (isset($direccion_suc))
                        echo $direccion_suc ?>" required>

                    <!-- Botones para regresar al menú anterior y enviar el formulario para actualizar -->
                    <button type="submit" name="enviar">Enviar</button>
                    <a href="index_sucursal.php">Regresar</a>
                </form>
            <?php
        }
        ?>
    </section>
</body>