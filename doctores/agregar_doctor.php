<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Doctor</title>
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
        
        $id_empleado = $_POST['id_empleado'];
        $id_consultorio = $_POST['id_consultorio'];
        
        $sql="INSERT INTO doctor(id_empleado,id_consultorio) 
        VALUES ('$id_empleado', '$id_consultorio')";
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_doctor.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_doctor.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{

    }
    ?>
<form action="" method="POST">

        <h1>Agregar Doctor</h1>
        <label for="">Empleado:</label>
        <select name="id_empleado" id="">
       
       <?php
       include("../conexion.php");
       $sql="SELECT id_empleado, concat(empleados.nombre_empleado,' ',empleados.apellido_paterno) 
       as nombre_doc from empleados where permiso_id=2 or permiso_id=1";
       $resultado=mysqli_query($conexion,$sql);
       while($row=mysqli_fetch_array($resultado)){
          // $id_empleado=$row['id_empleado'];
           
           $nombre_doc=$row['nombre_doc'];
           $id_empleado=$row['id_empleado'];
       ?>
       <option value="<?php echo $id_empleado;?>"><?php echo $nombre_doc;?></option>
       <?php
       
       }
       
       ?>

       
      </select>
      <label for="">Consultrio:</label>
      <select name="id_consultorio" id="">
       
       <?php
       include("../conexion.php");
       $sql="SELECT * from consultorio";
       $resultado=mysqli_query($conexion,$sql);
       while($row=mysqli_fetch_array($resultado)){
          // $id_empleado=$row['id_empleado'];
           
           $num_consultorio=$row['num_consultorio'];
           $id_consultorio=$row['id_consultorio'];
       ?>
       <option value="<?php echo $id_consultorio;?>"><?php echo $num_consultorio;?></option>
       <?php
       
       }
       
       ?>
       
      </select>
        <button class="btn" type="submit" name="enviar">Enviar</button>
        <a href="index_doctor.php">Regresar</a>
</body>
</section>
</html>