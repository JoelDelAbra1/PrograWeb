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
            $id_prueba=$_POST['id_prueba'];
            $nombre_prueba = $_POST['nombre_prueba'];
            $tipo_prueba = $_POST['tipo_prueba'];

            if(empty($_POST['nombre_prueba']) || empty($_POST['tipo_prueba'])){
                echo "<p>FALTAN COMPOR POR LLENAR</p>";
                
            }else{
            
                $sql=" update prueba_lab set nombre_prueba = '$nombre_prueba', tipo_prueba = '$tipo_prueba' 
                where id_prueba =".$id_prueba;
               $resultado = mysqli_query($conexion,$sql);
       
               if($resultado){
                   echo" <script languaje = 'JavaScript'>
                   alert('Los datos fueron guardados');
                   location.assign('index_prueba_lab.php');
                   </script>";
               }else{
                   echo" <script languaje = 'JavaScript'>
                   alert('ERROR: Los datos NO fueron guardados');
                   location.assign('index_prueba_lab.php');
                   </script>";
               }
               
           mysqli_close($conexion);
           } 
           }else{
               $id_prueba=$_GET['id_prueba'];
               $sql='SELECT * FROM prueba_lab WHERE id_prueba="'.$id_prueba.'"';
               $resultado=mysqli_query($conexion,$sql);
               $fila=(mysqli_fetch_assoc($resultado));  
               $id_prueba=$fila['id_prueba']; 
               $nombre_prueba= $fila["nombre_prueba"];
               $tipo_prueba= $fila["tipo_prueba"];
       
               mysqli_close($conexion);
           
           ?>

       <form action="" method="POST">
        <h1>Editar Prueba</h1>
       <input type="hidden" name="id_prueba" placeholder="Id prueba" value="<?php /// Se debe agregar oara que lo actualiza
               if(isset($id_prueba)) echo $id_prueba?>">

               <label for="">Nombre de la prueba:</label>
       <input type="text" name="nombre_prueba" placeholder="Nombre de la prueba" value="<?php
               if(isset($nombre_prueba)) echo $nombre_prueba?>" required>
               <label for="">Tipo de prueba:</label>
               <input type="text" name="tipo_prueba" placeholder="Tipo de prueba" value="<?php
               if(isset($tipo_prueba)) echo $tipo_prueba?>" required>
               <button type="submit" name="enviar">Enviar</button>
               <a href="index_prueba_lab.php">Regresar</a>
               </form>
           <?php
           } 
           ?> 
           </section>
       </body>