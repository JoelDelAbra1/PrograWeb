<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="shortcut icon" href="cabecera.jpg">
</head>

<body>
    <style>
        body {
            background-image: url('fondo2.webp');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
    <section class="form">
        <?php


if (isset($_POST['enviar'])) {
    if (empty($_POST['usuario']) || empty($_POST['pass'])) {
        echo "<script languaje = 'javaScript'>
            alert('Cedula o nombre vacios');
            location.assign('login.php');
            </script>";
    } else {
        include("conexion.php");
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $permiso_id = $_POST['permiso_id'];

        $sql = "select * from empleados where  usuario ='" . $usuario . "' and pass = '" . $pass . "' and permiso_id = '" . $permiso_id . "'";
        $resultado = mysqli_query($conexion, $sql);





        if ($fili = mysqli_fetch_assoc($resultado)) {

            include("conexion.php");
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];


            $sql = "select * from empleados where  usuario ='" . $usuario . "' and pass = '" . $pass . "' 
            and permiso_id = '" . $permiso_id . "'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);

            $nombre_empleado = $fila['nombre_empleado'];
            $permiso_id = $fila['permiso_id'];
            $id_sucursal = $fila['id_sucursal'];
            $id_empleado = $fila['id_empleado'];

            session_start();

            $_SESSION['nombre_empleado'] = $nombre_empleado;
            $_SESSION['permiso_id'] = $permiso_id;
            $_SESSION['id_sucursal'] = $id_sucursal;
            $_SESSION['id_empleado'] = $id_empleado;



            echo "<h1>!Bienvenido!</h1><br><h1>$nombre_empleado</h1><br>
                <a href='index.php'>Entrar</a>";




        } else {
            echo "<script languaje = 'javaScript'>
                alert('Cedula o nombre incorrectos');
                location.assign('login.php');
                </script>";
        }
    }
} else {
?>
        <center>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">


                <br>
                <h1>Iniciar Sesión</h1>
                <input type="email" name="usuario" placeholder="Usuario" required>
                <br>

                <input type="password" name="pass" placeholder="Contraseña" required>
                <br>

                <select name="permiso_id" id="">
                    <?php
    include("conexion.php");
    $sql = "SELECT * FROM t_permiso";
    $resultado = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($resultado)) {
        // $id_empleado=$row['id_empleado'];
        $nombre_permiso = $row['nombre_permiso'];
        $permiso_id = $row['permiso_id'];
        ?>
                    <option value="<?php echo $permiso_id; ?>">
                        <?php echo $nombre_permiso; ?>
                    </option>
                    <?php
    }
        ?>
                </select>
                <button type="submit" name="enviar">Ingresar</button>
            </form>
        </center>
        <?php
}
?>
</body>
</section>

</html>