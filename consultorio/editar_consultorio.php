<?php
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
        if(isset($_POST['enviar'])){ //presiona el boton
            include("../conexion.php");    
            $id_consultorio=$_POST['id_consultorio'];
            $num_consultorio = $_POST['num_consultorio'];
            $ubicacion_consultorio = $_POST['ubicacion_consultorio'];

            if(empty($_POST['num_consultorio']) || empty($_POST['ubicacion_consultorio'])){
                echo "<p>FALTAN COMPOR POR LLENAR</p>";
                
            }else{
            
                $sql=" update consultorio set num_consultorio = '$num_consultorio',
                ubicacion_consultorio = '$ubicacion_consultorio' 
                where id_consultorio =".$id_consultorio;
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
           } 
           }else{
               $id_consultorio=$_GET['id_consultorio'];
               $sql='SELECT * FROM consultorio WHERE id_consultorio="'.$id_consultorio.'"';
               $resultado=mysqli_query($conexion,$sql);
               $fila=(mysqli_fetch_assoc($resultado));  
               $id_consultorio=$fila['id_consultorio']; 
               $num_consultorio= $fila["num_consultorio"];
               $ubicacion_consultorio= $fila["ubicacion_consultorio"];
       
               mysqli_close($conexion);
           
           ?>
       <form action="" method="POST">
        <h1>Editar Consultorio</h1>
       <input type="hidden" name="id_consultorio" placeholder="Id del consultorio" value="<?php /// Se debe agregar oara que lo actualiza
               if(isset($id_consultorio)) echo $id_consultorio?>">
       <input type="text" name="num_consultorio" placeholder="Numero de consultorio" value="<?php
               if(isset($num_consultorio)) echo $num_consultorio?>" required>
               <input type="text" name="ubicacion_consultorio" placeholder="Ubicacion del consultorio" value="<?php
               if(isset($ubicacion_consultorio)) echo $ubicacion_consultorio?>" required>
               <button type="submit" name="enviar">Enviar</button>
               <a href="index_consultorio.php">Regresar</a>
               </form>
           <?php
           } 
           ?>
            </section>
       </body>