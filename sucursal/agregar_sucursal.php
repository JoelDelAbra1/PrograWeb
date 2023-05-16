<!--Archivo agregar_sucursal.php 
    Archivo para agregar una nueva sucursal-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post"> <!-- se enlaza el archivo CSS -->
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <section class="form">
    <?php
    if(isset($_POST['enviar'])){ // Verificar si el formulario ha sido enviado
        include("../conexion.php"); // Se incluye el archivo de conexión a la base de datos   
        
        $nombre_suc = $_POST['nombre_suc'];
        $direccion_suc = $_POST['direccion_suc'];
        $telefono_suc = $_POST['telefono_suc'];

        if(empty($_POST['nombre_suc']) || empty($_POST['direccion_suc']) || empty($_POST['telefono_suc'])){
            // Se verifica si los campos están vacíos
        }else{
            // Si los campos no están vacíos, se inserta la información en la base de datos
            $sql="INSERT INTO sucursal(direccion_suc,nombre_suc,telefono_suc) 
            VALUES ('$direccion_suc', '$nombre_suc', '$telefono_suc')";
            $resultado = mysqli_query($conexion,$sql);
            if($resultado){ // Verificar si la inserción fue exitosa
                // Si la inserción es exitosa, se muestra un mensaje de éxito y se redirige a la página principal de sucursal
                echo" <script languaje = 'JavaScript'>
                alert('Los datos fueron guardados');
                location.assign('index_sucursal.php');
                </script>";
            }else{
                // Si la inserción falla, se muestra un mensaje de error y se redirige a la página principal de sucursal
                echo" <script languaje = 'JavaScript'>
                alert('ERROR: Los datos NO fueron guardados');
                location.assign('index_sucursal.php');
                </script>";
            }
            mysqli_close($conexion);
        } 
    }
    ?>
    <form action="" method="POST">
        <h1>Agregar Sucursal</h1>
         <!-- Campo de entrada de texto para el nombre de la sucursal -->
        <input type="text" name="nombre_suc" placeholder="Nombre Sucursal" value="<?php
        if(isset($nombre_suc)) echo $nombre_suc?>" required>
        <!-- Campo de entrada de texto para el teléfono de la sucursal -->
        <input type="tel" name="telefono_suc" placeholder="Teledono Sucursal" value="<?php
        if(isset($telefono_suc)) echo $telefono_suc?>" required> 
        <!-- Campo de entrada de texto para la dirección de la sucursal -->
        <input type="text" name="direccion_suc" placeholder="Direccion sucursal" value="<?php
        if(isset($direccion_suc)) echo $direccion_suc?>" required> 
         <!-- Botón de envío del formulario -->
        <button type="submit" name="enviar">Enviar</button>
        <!-- Enlace para regresar a la pagina inicial de sucursales-->
        <a href="index_sucursal.php">Regresar</a> 
              </section>
        
</body>
</html>
