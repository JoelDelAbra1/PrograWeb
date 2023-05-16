<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="../estilos.css">
</head>

<body>
    <style>
        body {
            background-image: url('../fondo2.webp');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
    <section class="form">
        <h1>Agregar Empleado</h1>
        <?php
    if (isset($_POST['enviar'])) { //presiona el boton
        include("../conexion.php");

        $nombre_empleado = $_POST['nombre_empleado'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $ocupacion_empleado = $_POST['ocupacion_empleado'];
        $colonia_empleado = $_POST['colonia_empleado'];
        $calle_empleado = $_POST['calle_empleado'];
        $numerocasa_empleado = $_POST['numerocasa_empleado'];
        $telefono_empleado = $_POST['telefono_empleado'];
        $fecha_nac = $_POST['fecha_nac'];
        $id_sucursal = $_POST['id_sucursal'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $permiso_id = $_POST['permiso_id'];


        $sql = "INSERT INTO empleados(nombre_empleado, apellido_paterno, 
        apellido_materno, ocupacion_empleado, colonia_empleado, calle_empleado,
         numerocasa_empleado, telefono_empleado, fecha_nac,id_sucursal, usuario, pass, permiso_id) 
        VALUES ('$nombre_empleado', '$apellido_paterno', '$apellido_materno', '$ocupacion_empleado'
        , '$colonia_empleado', '$calle_empleado','$numerocasa_empleado',
        '$telefono_empleado', '$fecha_nac', '$id_sucursal', '$usuario', '$pass', '$permiso_id')";
        $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            echo " <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_emp.php');
            </script>";
        } else {
            echo " <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_emp.php');
            </script>";
        }
        mysqli_close($conexion);
    } else {

    }
    ?>
        <form action="" method="POST">
            <input type="text" name="nombre_empleado" placeholder="Nombre" required>
            <input type="text" name="apellido_paterno" placeholder="Apellido paterno" required>
            <input type="text" name="apellido_materno" placeholder="Apellido Materno" required>
            <input type="text" name="ocupacion_empleado" placeholder="Ocupacion" required>
            <input type="text" name="colonia_empleado" placeholder="Colonia" required>
            <input type="text" name="calle_empleado" placeholder="Calle" required>
            <input type="text" name="numerocasa_empleado" placeholder="Numero Casa" required>
            <input type="tel" name="telefono_empleado" placeholder="Telefono" required>
            <input type="email" name="usuario" placeholder="Usuario" required>
            <input type="text" name="pass" placeholder="Contraseña" required>
            <label for="">Fecha de Nacimineto:</label>
            <input type="date" name="fecha_nac" placeholder="Fecha de Nacimineto" required>
            <label for="">Sucursal:</label>
            <select name="id_sucursal" id="">

                <?php
        include("../conexion.php");
        $sql = "select * from sucursal";
        $resultado = mysqli_query($conexion, $sql);
        while ($row = mysqli_fetch_array($resultado)) {
            // $id_empleado=$row['id_empleado'];
            $id_sucursal = $row['id_sucursal'];
            $direccion_suc = $row['direccion_suc'];

        ?>
                <option value="<?php echo $id_sucursal; ?>">
                    <?php echo $direccion_suc; ?>
                </option>
                <?php

        }

        ?>

            </select>

            <label for="">Permisos:</label>
            <select name="permiso_id" id="">

                <?php
        include("../conexion.php");
        $sql = "select * from t_permiso";
        $resultado = mysqli_query($conexion, $sql);
        while ($row = mysqli_fetch_array($resultado)) {
            // $id_empleado=$row['id_empleado'];
            $permiso_id = $row['permiso_id'];
            $nombre_permiso = $row['nombre_permiso'];

        ?>
                <option value="<?php echo $permiso_id; ?>">
                    <?php echo $nombre_permiso; ?>
                </option>
                <?php

        }

        ?>

            </select>
            <button type="submit" name="enviar">Enviar</button>
            <a href="index_emp.php">Regresar</a>
    </section>
</body>

</html>