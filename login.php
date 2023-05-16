<!-- Archivo login.php 
    Sirve para poder iniciar sesion-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> 
       <!-- Estilos CSS-->
    <link rel="stylesheet" href="estilos.css">
    <link rel="shortcut icon" href="cabecera.jpg">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="form">
        <?php

        // Verificar si se ha enviado el formulario
        if (isset($_POST['enviar'])) {

            // Verificar si los campos de usuario y contraseña están vacíos
            if (empty($_POST['usuario']) || empty($_POST['pass'])) {
                // Mostrar una alerta y redirigir a login.php
                echo "<script languaje='javaScript'>
                        alert('Cedula o nombre vacios');
                        location.assign('login.php');
                      </script>";
            } else {
                include("conexion.php"); // Incluir archivo de conexión a la base de datos
                $usuario = $_POST['usuario'];
                $pass = $_POST['pass'];
                $permiso_id = $_POST['permiso_id'];

                // Consulta para verificar las credenciales del usuario en la base de datos
                $sql = "select * from empleados where usuario ='" . $usuario . "' and pass = '" 
                . $pass . "' and permiso_id = '" . $permiso_id . "'";
                $resultado = mysqli_query($conexion, $sql);

                // Si se encontró una fila coincidente en la consulta
                if ($fili = mysqli_fetch_assoc($resultado)) {
                    include("conexion.php"); // Incluir archivo de conexión a la base de datos
                    $usuario = $_POST['usuario'];
                    $pass = $_POST['pass'];

                    // Realizar otra consulta para obtener los datos del empleado
                    $sql = "select * from empleados where usuario ='" . $usuario . "' 
                    and pass = '" . $pass . "' 
                    and permiso_id = '" . $permiso_id . "'";
                    $resultado = mysqli_query($conexion, $sql);

                    $fila = mysqli_fetch_assoc($resultado);

                    // Obtener los datos del empleado para almacenarlos en la sesión
                    $nombre_empleado = $fila['nombre_empleado'];
                    $permiso_id = $fila['permiso_id'];
                    $id_sucursal = $fila['id_sucursal'];
                    $id_empleado = $fila['id_empleado'];

                    // Continuación del archivo login.php
                    session_start(); // Iniciar sesión
        
                    // Almacenar los datos del empleado en variables de sesión
                    $_SESSION['nombre_empleado'] = $nombre_empleado;
                    $_SESSION['permiso_id'] = $permiso_id;
                    $_SESSION['id_sucursal'] = $id_sucursal;
                    $_SESSION['id_empleado'] = $id_empleado;

                    // Mostrar mensaje de bienvenida y enlace para entrar
                    echo "<h1>¡Bienvenido!</h1><br><h1>$nombre_empleado</h1><br>
                          <a href='index.php'>Entrar</a>";
                } else {

                    // Mostrar una alerta y volver a mandarlo a iniciar sesion
                    echo "<script languaje='javaScript'>
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
                        // Se generran opciones con los datos provenientes de la base de datos

                        // Incluir archivo de conexión a la base de datos
                        include("conexion.php"); 
                        $sql = "SELECT * FROM t_permiso";
                        $resultado = mysqli_query($conexion, $sql);

                        // Por cada resultado se generara una opcion
                        while ($row = mysqli_fetch_array($resultado)) { 
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
                    <!-- boton para iniciar sesion -->
                    <button type="submit" name="enviar">Ingresar</button>
                </form>
            </center>
            <?php
        }
        ?>
    </section>
</body>
</html>