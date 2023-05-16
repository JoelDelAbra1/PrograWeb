<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <section class="form">
        <body>
        <style>
body {
  background-image: url('../fondo2.webp');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
        <?php
        if(isset($_POST['enviar'])){ //presiona el boton
            include("../conexion.php");    
            
            $nombre_permiso = $_POST['nombre_permiso'];
            $desc_permiso = $_POST['desc_permiso'];
            
            $sql="INSERT INTO t_permiso (nombre_permiso, desc_permiso) 
            VALUES ('$nombre_permiso', '$desc_permiso')";
            $resultado = mysqli_query($conexion,$sql);
            if($resultado){
                echo" <script languaje = 'JavaScript'>
                alert('Los datos fueron guardados');
                location.assign('index_t_permisos.php');
                </script>";
            }else{
                echo" <script languaje = 'JavaScript'>
                alert('ERROR: Los datos NO fueron guardados');
                location.assign('index_t_permisos.php');
                </script>";
            }
            mysqli_close($conexion);
        }else{

        }
        ?>
    <form action="" method="POST">
        <h1>Agregar Permiso</h1>
            <input type="text" name="nombre_permiso" placeholder="Nombre del permiso" required>
            <input type="text" name="desc_permiso" placeholder="Descripcion del permiso" required>
            <button type="submit" name="enviar">Enviar</button>
            <a href="index_t_permisos.php">Regresar</a>
    </body>
</section>
</html>