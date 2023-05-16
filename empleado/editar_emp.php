<?php
include("../conexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleados</title>
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
        <?php
        if (isset($_POST['enviar'])) {

            $id_empleado = $_POST["id_empleado"];
            $nombre_empleado = $_POST["nombre_empleado"];
            $apellido_paterno = $_POST["apellido_paterno"];
            $apellido_materno = $_POST["apellido_materno"];
            $colonia_empleado = $_POST["colonia_empleado"];
            $calle_empleado = $_POST["calle_empleado"];
            $telefono_empleado = $_POST["telefono_empleado"];
            $fecha_nac = $_POST['fecha_nac'];
            $id_sucursal = $_POST['id_sucursal'];
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $permiso_id = $_POST['permiso_id'];
            $ocupacion_empleado = $_POST["ocupacion_empleado"];
            $numerocasa_empleado = $_POST['numerocasa_empleado'];

            if (
                empty($_POST['nombre_empleado']) || empty($_POST['apellido_paterno']) || empty($_POST['apellido_materno'])
                || empty($_POST['colonia_empleado']) || empty($_POST['calle_empleado']) || empty($_POST['telefono_empleado'])
            ) {
                echo " <script languaje = 'JavaScript'>
            alert('ERROR: Faltaron Datos');
            location.assign('index_emp.php');
            </script>";

            } else {
                $sql = "update empleados set nombre_empleado='" . $nombre_empleado . "',apellido_paterno='" . $apellido_paterno . "',
        apellido_paterno='" . $apellido_paterno . "',permiso_id='" . $permiso_id . "', ocupacion_empleado='" . $ocupacion_empleado . "',
        colonia_empleado='" . $colonia_empleado . "',calle_empleado='" . $calle_empleado . "',numerocasa_empleado='" . $numerocasa_empleado . "',
        telefono_empleado='" . $telefono_empleado . "',fecha_nac='" . $fecha_nac . "',id_sucursal='" . $id_sucursal . "',usuario='" . $usuario . "',
        pass='" . $pass . "', ocupacion_empleado='" . $ocupacion_empleado . "' where id_empleado='" . $id_empleado . "'";
                $resultado = mysqli_query($conexion, $sql);
                if ($resultado) {
                    echo " <script languaje = 'JavaScript'>
            alert('Los datos fueron actualizados');
            location.assign('index_emp.php');
            </script>";
                } else {
                    echo " <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron actualizados');
            location.assign('index_emp.php');
            </script>";
                }
                mysqli_close($conexion);
            }
        } else {

            $id_empleado = $_GET['id_empleado']; //recupera el valor del otro
            $sql = "select * from empleados where id_empleado = '" . $id_empleado . "'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);
            $id_empleado = $fila["id_empleado"];
            $nombre_empleado = $fila["nombre_empleado"];
            $apellido_paterno = $fila["apellido_paterno"];
            $apellido_materno = $fila["apellido_materno"];
            $colonia_empleado = $fila["colonia_empleado"];
            $calle_empleado = $fila["calle_empleado"];
            $telefono_empleado = $fila["telefono_empleado"];
            $ocupacion_empleado = $fila["ocupacion_empleado"];
            $fecha_nac = $fila['fecha_nac'];
            $id_sucursal = $fila['id_sucursal'];
            $usuario = $fila['usuario'];
            $pass = $fila['pass'];
            $permiso_id1 = $fila['permiso_id'];
            $numerocasa_empleado = $fila['numerocasa_empleado'];



            mysqli_close($conexion);

        ?>


        <h1>Editar Empleado</h1>
        <form action="" method="post">
            <input type="hidden" name="id_empleado" placeholder="Id" value="<?php echo $id_empleado; ?>"> <br>
            <label for="">Nombre</label>
            <input type="text" name="nombre_empleado" placeholder="Nombre" value="<?php if (isset($nombre_empleado))
                echo $nombre_empleado ?>" required> <br>
            <label for="">Apellido paterno</label>
            <input type="text" name="apellido_paterno" placeholder="Apellido paterno" value="<?php if (isset($apellido_paterno))
                echo $apellido_paterno ?>" required> <br>
            <label for="">Apellido Materno</label>
            <input type="text" name="apellido_materno" placeholder="Apellido Materno" value="<?php if (isset($apellido_materno))
                echo $apellido_materno ?>" required> <br>
            <label for="">Colonia</label>
            <input type="text" name="colonia_empleado" placeholder="Colonia" value="<?php if (isset($colonia_empleado))
                echo $colonia_empleado ?>" required> <br>
            <label for="">Calle</label>
            <input type="text" name="calle_empleado" placeholder="Calle" value="<?php if (isset($calle_empleado))
                echo $calle_empleado ?>" required> <br>
            <label for="">Teléfono</label>
            <input type="text" name="telefono_empleado" placeholder="Teléfono" value="<?php if (isset($telefono_empleado))
                echo $telefono_empleado ?>" required> <br>
            <label for="">Numero de Casa</label>
            <input type="text" name="numerocasa_empleado" placeholder="Numero Casa"
                value="<?php echo $numerocasa_empleado; ?>" required>
            <label for="">Ocupacion</label>
            <input type="text" name="ocupacion_empleado" placeholder="Ocupacion"
                value="<?php echo $ocupacion_empleado; ?>" required>
            <label for="">Fecha de Nacimineto</label>
            <input type="date" name="fecha_nac" placeholder="Fecha de Nacimineto" value="<?php echo $fecha_nac; ?>"
                required>
            <label for="">Correo</label>
            <input type="email" name="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>" required>
            <label for="">Contraseña</label>
            <input type="text" name="pass" placeholder="Contraseña" value="<?php echo $pass; ?>" required>

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
                if ($permiso_id == $permiso_id1) { ?>

                <option value="<?php echo $permiso_id; ?>" selected>
                    <?php echo $nombre_permiso; ?>
                </option>
                <?php
                } else { ?>
                <option value="<?php echo $permiso_id; ?>">
                    <?php echo $nombre_permiso; ?>
                </option>
                <?php

                }
            }
                ?>

            </select>
            <button type="submit" name="enviar">Enviar</button>
            <a href="index_emp.php">Regresar</a>
        </form>
        <?php
        }
        ?>
    </section>
</body>

</html>