<!-- Archivo para agregar un nuevo consultorio-->
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
        <!-- Estilos CSS en linea para el fondo-->
    <style>
        
body {
  background-image: url('../fondo2.webp');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>
        <?php 
        // Verificar si se ha enviado el formulario
        if(isset($_POST['enviar'])){ //presiona el boton
            include("../conexion.php");// Se incluye el archivo de conexión a la base de datos 
            
            $num_consultorio = $_POST['num_consultorio'];
            $ubicacion_consultorio = $_POST['ubicacion_consultorio'];
            
            $sql="INSERT INTO consultorio(num_consultorio, ubicacion_consultorio) 
            VALUES ('$num_consultorio', '$ubicacion_consultorio')";
            $resultado = mysqli_query($conexion,$sql);
            //Verificar si la insersion fue exitosa
            if($resultado){
                //Si es exitosa, se muestra  mensaje de éxito y se redirige a la página principal de consultorio
                echo" <script languaje = 'JavaScript'>
                alert('Los datos fueron guardados');
                location.assign('index_consultorio.php');
                </script>";
            }else{
                //Si falla, se muestra mensaje de éxito y se redirige a la página principal de consultorio
                echo" <script languaje = 'JavaScript'>
                alert('ERROR: Los datos NO fueron guardados');
                location.assign('index_consultorio.php');
                </script>";
            }
            //Se cierra la conexion a la base de datos
            mysqli_close($conexion);
        }else{

        }
        ?>
        <!-- Estructura del formulario para agregar un nuevo consultario-->
        <section class="form">
    <form action="" method="POST">
        <h1>Agregar Consultorio</h1>
            <!-- Campo de entrada de texto para el numero del consultario-->
            <input type="text" name="num_consultorio" placeholder="Numero de consultorio" pattern="[0-9]{1,5}" required> 
            <!-- Campo de entrada de texto para la ubicacion del consultario-->
            <input type="text" name="ubicacion_consultorio" placeholder="Ubicacion del consultorio" required>
            <!-- Botón de envío del formulario -->
            <button class="botons" type="submit" name="enviar">Enviar</button>
             <!-- Enlace para regresar a la pagina inicial de consultorio-->
            <a href="index_consultorio.php">Regresar</a>
        </section>
    </body>
</html>