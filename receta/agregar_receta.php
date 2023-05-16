<?php
// Se incluye el archivo de la conexion a la base de datos
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

        //Primero se comprueba si se ha presionado el boton para agegar
        if (isset($_POST['enviar'])) {

            // Se recuperan los valores que se ingresaron en los inputs
            $id_cita = $_POST['id_cita'];
            $dosis_medicamento = $_POST['dosis_medicamento'];
            $frecuencia_medicamento = $_POST['frecuencia_medicamento'];
            $id_prueba = $_POST['id_prueba'];


            // Se crea la consulta SQL
            $sql = "INSERT INTO recetas(id_cita,dosis_medicamento,frecuencia_medicamento,id_prueba) 
        VALUES ( '$id_cita', '$dosis_medicamento'
        , '$frecuencia_medicamento', '$id_prueba')";

            //Se ejecuta la consulta SQL
            $resultado = mysqli_query($conexion, $sql);

            // Si si se realiza la consulta correctamente
            if ($resultado) {

                // Cuando se genera una recete se cambia automaticamnte el estado a completado
                // Por lo que se genera la consulta SQL 
                $sql = " update cita set estado_cita = 'Completada' 
            where id_cita =" . $id_cita;

                // Se ejecuta la consulta
                $resultado = mysqli_query($conexion, $sql);

                //Se imprime una alerta avisando que se realizo correctamnte la consulta
                echo " <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('../citas/index_citas.php');
            </script>";

                //De lo contrario se imprime una alerta avisando que NO realizo correctamnte la consulta
            } else {
                echo " <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('../citas/index_citas.php');
            </script>";
            }
            // Se cierra la conexion
            mysqli_close($conexion);

            // Si no se ha presionado el boton enviar
        
        } else { // Se van a recuperar los datos y mostrarlos en los input
            $id_cita = $_GET['id_cita'];

            //Se crea y se ejecuta la consulta
            $sql = "select * from v_citas where id_cita= '" . $id_cita . "'";
            $resultado = mysqli_query($conexion, $sql);

            // Se asigna el array asosiativo a la variable fila
            $fila = mysqli_fetch_assoc($resultado);

            //Con la variable fila se empiezan a aasignar los valores que se mostraran automaticamente
            // al querer agregar un nuevo registro
        
            $id_paciente = $fila["id_paciente"];
            $hora_cita = $fila["hora_cita"];
            $fecha_cita = $fila["fecha_cita"];
            $Doctor = $fila["doctor"];
            $telefono_empleado = $fila["telefono_empleado"];
            $telefono_paciente = $fila["telefono_paciente"];
            $paciente = $fila["paciente"];
            $nombre_suc = $fila["nombre_suc"];
            $direccion_suc = $fila["direccion_suc"];
            $telefono_suc = $fila["telefono_suc"];

            // Se cierra la conexion
            mysqli_close($conexion);
        }
        ?>

        <!-- Se tiene el form para poder agregar un nuevo registro-->
        <form action="" method="POST">
            <label></label>
            <h2>Sucursal</h2>

            <!-- A continuacion se tienen campos que se llenan automaticamnte ya que se le asignan los valores obtenidos anteriormente-->
            <label>Sucursal:</label>
            <input type="text" name="nombre_suc" value="<?php echo $nombre_suc; ?>" readonly>
            <label>Dirrección:</label>
            <input type="text" name="direccion_suc" value="<?php echo $direccion_suc; ?>" readonly>
            <label>Telefono:</label>
            <input type="text" name="telefono_suc" value="<?php echo $telefono_suc; ?>" readonly>

            <h1>RECETA MÉDICA</h1>
            <h2>Datos del Paciente</h2>
            <label>Paciente:</label>
            <input type="text" name="paciente" value="<?php echo $paciente; ?>" readonly>
            <label>Telefono:</label>
            <input type="text" name="telefono_paciente" value="<?php echo $telefono_paciente; ?>" readonly>
            <label>Hora:</label>
            <input type="text" name="hora_cita" value="<?php echo $hora_cita; ?>" readonly>
            <label>Fecha:</label>
            <input type="text" name="fecha_cita" value="<?php echo $fecha_cita; ?>" readonly>

            <input type="hidden" name="id_cita" value="<?php echo $id_cita; ?>" readonly>

            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>" readonly>

            <h2>Doctor</h2>
            <label>Doctor:</label>
            <input type="text" name="Doctor" value="<?php echo $Doctor; ?>" readonly>
            <label>Telefono Doctor:</label>
            <input type="text" name="telefono_empleado" value="<?php echo $telefono_empleado; ?>" readonly>

            <!-- A continuacion se tienen campos los cuales seran rellenados por los usuarios-->
            <h2>Cuerpo de la receta</h2>
            <input type="text" name="dosis_medicamento" placeholder="Dosis" required>
            <input type="text" name="frecuencia_medicamento" placeholder="Frecuencia" required>

            <!-- Se tiene un select con datos que vienen de la base de datos-->
            <label>Prueba a realizar:</label>
            <select name="id_prueba" id="">

                <?php
                include("../conexion.php");
                $sql = "select * from prueba_lab";
                $resultado = mysqli_query($conexion, $sql);
                while ($row = mysqli_fetch_array($resultado)) { //Se generaran opciones con los datos que obtuvieron
                    $tipo_prueba = $row['tipo_prueba'];
                    $nombre_prueba = $row['nombre_prueba'];
                    $id_prueba = $row['id_prueba'];
                    ?>
                    <option value="<?php echo $id_prueba; ?>"><?php echo $nombre_prueba; ?></option>
                    <?php

                }

                ?>

            </select>
            <!--Boton de envio de formilario-->
            <button type="submit" name="enviar">Guardar</button>
            <!-- Enlace para regresar a la pagina inicial de consultorio-->
            <a href="../citas/index_citas.php">Regresar</a>
</body>
</section>

</html>