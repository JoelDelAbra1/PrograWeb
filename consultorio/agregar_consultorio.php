<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agregar</title>
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
        <?php
        if(isset($_POST['enviar'])){ //presiona el boton
            include("../conexion.php");    
            
            $num_consultorio = $_POST['num_consultorio'];
            $ubicacion_consultorio = $_POST['ubicacion_consultorio'];
            
            $sql="INSERT INTO consultorio(num_consultorio, ubicacion_consultorio) 
            VALUES ('$num_consultorio', '$ubicacion_consultorio')";
            $resultado = mysqli_query($conexion,$sql);
            if($resultado){
                echo" <script languaje = 'JavaScript'>
                alert('Los datos fueron guardados');
                location.assign('index_consultorio.php');
                </script>";
            }else{
                echo" <script languaje = 'JavaScript'>
                alert('ERROR: Los datos NO fueron guardados');
                location.assign('index_consultorio.php');
                </script>";
            }
            mysqli_close($conexion);
        }else{

        }
        ?>
        <section class="form">
    <form action="" method="POST">
        <h1>Agregar Consultorio</h1>
            <input type="text" name="num_consultorio" placeholder="Numero de consultorio" pattern="[0-9]{1,5}" required> 
            <input type="text" name="ubicacion_consultorio" placeholder="Ubicacion del consultorio" required>
            <button class="botons" type="submit" name="enviar">Enviar</button>
            <a href="index_consultorio.php">Regresar</a>
        </section>
    </body>
</html>