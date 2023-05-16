<?php
include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Recibo</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <section class="form">
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
        
       $id_cita=$_POST['id_cita'];
       $costo=$_POST['costo'];
       $fecha_generacion=$_POST['fecha_generacion'];
       $hora_generacion=$_POST['hora_generacion'];
       

        $sql="INSERT INTO recibo(id_cita,costo,fecha_generacion,hora_generacion) 
        VALUES ( '$id_cita', '$costo'
        , '$fecha_generacion', '$hora_generacion')";
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('../citas/index_citas.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_citas.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{ //Recuperar los datos y mostrarlos en los input
        
        $id_cita=$_GET['id_cita'];
        $sql="select * from v_citas where id_cita= '".$id_cita."'";
        $resultado = mysqli_query($conexion,$sql);

        $fila= mysqli_fetch_assoc($resultado);
        date_default_timezone_set('America/Mexico_City');
        
        
        $fecha_generacion= date('d/m/y');
        $hora_generacion= date('G:i:s ');
        $paciente= $fila["paciente"];
        $telefono_paciente= $fila["telefono_paciente"];
        $nombre_suc= $fila["nombre_suc"];
        $direccion_suc= $fila["direccion_suc"];
        $telefono_suc= $fila["telefono_suc"];
        mysqli_close($conexion);
    }
    ?> 
    
<form action="" method="POST"> 
    <label ></label>
    <input type="hidden" name="id_cita" value="<?php echo $id_cita; ?>">
    <h2>Sucursal</h2>
    <label >Sucursal:</label>
        <input type="text" name="nombre_suc" value="<?php echo $nombre_suc; ?>">
        <label >Dirrección:</label>
        <input type="text" name="direccion_suc" value="<?php echo $direccion_suc; ?>">
        <label >Telefono:</label>
        <input type="text" name="telefono_suc" value="<?php echo $telefono_suc; ?>">

    <h1>RECETA MÉDICA</h1>
    <h2>Datos del Paciente</h2>
    <label >Paciente:</label>
        <input type="text" name="paciente" value="<?php echo $paciente; ?>">
        <label >Telefono:</label>
        <input type="text" name="telefono_paciente" value="<?php echo $telefono_paciente; ?>">
        <label >Hora:</label>
        <input type="text" name="hora_generacion" value="<?php echo $hora_generacion; ?>">
        <label >Fecha:</label>
        <input type="text" name="fecha_generacion" value="<?php echo $fecha_generacion; ?>">

<input type="hidden" name="id_cita" value="<?php echo $id_cita; ?>">
       
        
        
        
        
       
        
     <h2>Cuerpo del Recibo</h2>
     <label for="">Se pagaran: </label>
      <input type="text" name="costo" placeholder="Costo" required>
      

      
    
        <button type="submit" name="enviar">Guardar</button>
        <a href="../citas/index_citas.php">Regresar</a>
        </section>
</body>
</html>