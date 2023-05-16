<?php
include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Receta</title>
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
        
        $id_recibo=$_POST['id_recibo'];
       $costo=$_POST['costo'];
       $fecha_generacion=$_POST['fecha_generacion'];
       $hora_generacion=$_POST['hora_generacion'];
       

        $sql="UPDATE recibo set costo = '$costo', fecha_generacion= '$fecha_generacion',hora_generacion='$hora_generacion' 
        where id_recibo =".$id_recibo;
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_recibos.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_citas.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{ //Recuperar los datos y mostrarlos en los input
        
        $id_recibo=$_GET['id_recibo'];
        $sql="select * from v_recibo where id_recibo= '".$id_recibo."'";
        $resultado = mysqli_query($conexion,$sql);

        $fila= mysqli_fetch_assoc($resultado);
        date_default_timezone_set('America/Mexico_City');
        
        /// cambiar
        $id_recibo= $fila["id_recibo"];
        $fecha_generacion= $fila["fecha_generacion"];
        $hora_generacion= $fila["hora_generacion"];
        $paciente= $fila["paciente"];
        $telefono_paciente= $fila["telefono_paciente"];
        $nombre_suc= $fila["nombre_suc"];
        $direccion_suc= $fila["direccion_suc"];
        $telefono_suc= $fila["telefono_suc"];
        $costo= $fila["costo"];
        mysqli_close($conexion);
    }
    ?> 
    
<form action="" method="POST"> 
    <label ></label>
    
    <h2>Sucursal</h2>
    <input type="hidden" name="id_recibo" value="<?php echo $id_recibo; ?>" readonly>
    <label >Sucursal:</label>
        <input type="text" name="nombre_suc" value="<?php echo $nombre_suc; ?>" readonly>
        <label >Dirrección:</label>
        <input type="text" name="direccion_suc" value="<?php echo $direccion_suc; ?>" readonly> 
        <label >Telefono:</label>
        <input type="text" name="telefono_suc" value="<?php echo $telefono_suc; ?>" readonly>

    <h1>RECETA MÉDICA</h1>
    <h2>Datos de la Cita</h2>
    <label >Paciente:</label>
        <input type="text" name="paciente" value="<?php echo $paciente; ?>" readonly>
        <label >Telefono:</label>
        <input type="text" name="telefono_paciente" value="<?php echo $telefono_paciente; ?>" readonly>
        <label >Hora:</label>
        <input type="text" name="hora_generacion" value="<?php echo $hora_generacion; ?>" readonly>
        <label >Fecha:</label>
        <input type="text" name="fecha_generacion" value="<?php echo $fecha_generacion; ?>" readonly>

       
        
        
        
        
       
        
     <h2>Cuerpo del Recibo</h2>
     <label for="">Se pagaran: </label>
      <input type="text" name="costo" placeholder="Costo" value="<?php echo $costo; ?>" required>
      

      
    
        <button type="submit" name="enviar">Guardar</button>
        <a href="index_recibos.php">Regresar</a>
    </section>
</body>
</html>