<!-- Archivo para poder editar un consultorio existente-->
<?php //Se incluye el archivo de la conexion para acceder a la base de datos 
include("../conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar</title>
        <link rel="stylesheet" href="../estilos.css">
    </head>
    <body>
        <!-- Estilos CSS en línea para el fondo -->
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
        // Verificar si se ha enviado el formulario
        if(isset($_POST['enviar'])){ //presiona el boton
            include("../conexion.php");
            //Almacena cada uno de los valores recibidos por el POST    
            $id_consultorio=$_POST['id_consultorio'];
            $num_consultorio = $_POST['num_consultorio'];
            $ubicacion_consultorio = $_POST['ubicacion_consultorio'];

            //Verifica si los campos numero de consultorio y ubcacion estan vacios
            if(empty($_POST['num_consultorio']) || empty($_POST['ubicacion_consultorio'])){
                //En caso afirmativo mostrar alerta
                echo "<p>FALTAN COMPOR POR LLENAR</p>";
                
            }else{
                //Almacenar en una varibale la instruccion de actualizar la información del consultorio en la base de datos
                $sql=" update consultorio set num_consultorio = '$num_consultorio',
                ubicacion_consultorio = '$ubicacion_consultorio' 
                where id_consultorio =".$id_consultorio;
               $resultado = mysqli_query($conexion,$sql);
                
               //Verificar si la actualizacion fue exitosa
               if($resultado){
                    //Si es exitosa, mostrar mensaje de éxito y se redirige a la página principal de consultorio
                   echo" <script languaje = 'JavaScript'>
                   alert('Los datos fueron guardados');
                   location.assign('index_consultorio.php');
                   </script>";
               }else{
                //Si falla, se muestra mensaje de error y se redirige a la página principal de consultorio
                   echo" <script languaje = 'JavaScript'>
                   alert('ERROR: Los datos NO fueron guardados');
                   location.assign('index_consultorio.php');
                   </script>";
               }
            //Cerrar la conexion a la base de datos
           mysqli_close($conexion);
           } 
           }// Si el formulario no se a enviado
           else{ //Consulta para obtener la informacion del consultario seleccionado para editar
               $id_consultorio=$_GET['id_consultorio'];
               $sql='SELECT * FROM consultorio WHERE id_consultorio="'.$id_consultorio.'"';
               $resultado=mysqli_query($conexion,$sql);
               $fila=(mysqli_fetch_assoc($resultado));  
               $id_consultorio=$fila['id_consultorio']; 
               $num_consultorio= $fila["num_consultorio"];
               $ubicacion_consultorio= $fila["ubicacion_consultorio"];
                //Cerrar la conexion a la base de datos
               mysqli_close($conexion);
           
           ?>
        <!-- Estructura del formulario para agregar un nuevo consultario-->
       <form action="" method="POST">
        <h1>Editar Consultorio</h1>
       <input type="hidden" name="id_consultorio" placeholder="Id del consultorio" value="<?php /// Se debe agregar oara que lo actualiza
               if(isset($id_consultorio)) echo $id_consultorio?>">
               <!-- Campo de entrada de texto para el numero del consultario-->
       <input type="text" name="num_consultorio" placeholder="Numero de consultorio" value="<?php
               if(isset($num_consultorio)) echo $num_consultorio?>" required>
               <!-- Campo de entrada de texto para la ubicación del consultario-->
               <input type="text" name="ubicacion_consultorio" placeholder="Ubicacion del consultorio" value="<?php
               if(isset($ubicacion_consultorio)) echo $ubicacion_consultorio?>" required>
               <!-- Botón de envío del formulario -->
               <button type="submit" name="enviar">Enviar</button>
               <!-- Enlace para regresar a la pagina inicial de consultorio-->
               <a href="index_consultorio.php">Regresar</a>
               </form>
           <?php
           } 
           ?>
            </section>
       </body>