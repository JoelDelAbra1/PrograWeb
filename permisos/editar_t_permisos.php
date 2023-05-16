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
    <body>  <section class="form">
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
            include("conexion.php");    
            $permiso_id=$_POST['permiso_id'];
            $nombre_permiso = $_POST['nombre_permiso'];
            $desc_permiso = $_POST['desc_permiso'];

            
                if(empty($_POST['nombre_permiso']) || empty($_POST['desc_permiso'])){
                    echo" <script languaje = 'JavaScript'>
                    alert('ERROR: Faltaron Datos');
                    location.assign('index_t_permisos.php');
                    </script>";
        
            }else{
            
                $sql=" update t_permiso set nombre_permiso = '$nombre_permiso', desc_permiso = '$desc_permiso' 
                where permiso_id =".$permiso_id;
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
           } 
           }else{
               $permiso_id=$_GET['permiso_id'];
               $sql='SELECT * FROM t_permiso WHERE permiso_id="'.$permiso_id.'"';
               $resultado=mysqli_query($conexion,$sql);
               $fila=(mysqli_fetch_assoc($resultado));  
               $permiso_id=$fila['permiso_id']; 
               $nombre_permiso= $fila["nombre_permiso"];
               $desc_permiso= $fila["desc_permiso"];
       
               mysqli_close($conexion);
           
           ?>
       <form action="" method="POST">
        <h1>Editar Permiso</h1>

       <input type="hidden" name="permiso_id" placeholder="Id del permiso" value="<?php /// Se debe agregar oara que lo actualiza
               if(isset($permiso_id)) echo $permiso_id?>">
               <label for="">Nombre del permiso:</label>
       <input type="text" name="nombre_permiso" placeholder="Nombre del permiso" value="<?php
               if(isset($nombre_permiso)) echo $nombre_permiso?>" required>
               <label for="">Descripcion del permiso:</label>
               <input type="text" name="desc_permiso" placeholder="" value="<?php
               if(isset($desc_permiso)) echo $desc_permiso?>" required>
               <button type="submit" name="enviar">Enviar</button>
               <a href="index_t_permisos.php">Regresar</a>
               </form>
           <?php
           } 
           ?> 
       </body></section>