<?php
include("../conexion.php");
?>
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
<section class="form">
    <?php
    if(isset($_POST['enviar'])){ //presiona el boton
        include("conexion.php");    
        $id_receta=$_POST['id_receta'];
       $dosis_medicamento=$_POST['dosis_medicamento'];
       $frecuencia_medicamento=$_POST['frecuencia_medicamento'];
       $id_prueba=$_POST['id_prueba'];
       
        if(empty($_POST['dosis_medicamento']) || empty($_POST['frecuencia_medicamento'])){
            echo "<p>FALTAN COMPOR POR LLENAR</p>";
            
        }else{
        
        $sql=" update recetas set dosis_medicamento = '$dosis_medicamento', frecuencia_medicamento = '$frecuencia_medicamento',
        id_prueba = '$id_prueba' where id_receta =".$id_receta;
        $resultado = mysqli_query($conexion,$sql);

        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_recetas.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_sucursal.php');
            </script>";
        }
        
    mysqli_close($conexion);
    } 
    }else{
         $id_receta= $_GET["id_receta"];
        $sql='SELECT * FROM v_receta WHERE id_receta="'.$id_receta.'"';
        $resultado = mysqli_query($conexion,$sql);
        $fila= mysqli_fetch_assoc($resultado);
       $id_receta= $fila["id_receta"];
        $id_paciente= $fila["id_paciente"];
       $hora_cita= $fila["hora_cita"];
       $fecha_cita= $fila["fecha_cita"];
        $Doctor= $fila["Doctor"];
        $telefono_empleado= $fila["telefono_empleado"];
         $paciente= $fila["paciente"]; 
         $telefono_paciente= $fila["telefono_paciente"];
      $nombre_suc= $fila["nombre_suc"];
      $direccion_suc= $fila["direccion_suc"];
      $telefono_suc= $fila["telefono_suc"];
        $dosis_medicamento=$fila['dosis_medicamento'];
        $frecuencia_medicamento=$fila['frecuencia_medicamento'];
        $nombre_prueba1=$fila['nombre_prueba'];
        mysqli_close($conexion);

        
    }
    ?>
   
   <form action="" method="POST"> 
    <label ></label>
    <h2>Sucursal</h2>
    <label >Sucursal:</label>
        <input type="text" name="nombre_suc" value="<?php echo $nombre_suc; ?>" readonly>
        <label >Dirrección:</label>
        <input type="text" name="direccion_suc" value="<?php echo $direccion_suc; ?>" readonly>
        <label >Telefono:</label>
        <input type="text" name="telefono_suc" value="<?php echo $telefono_suc; ?>" readonly>

    <h1>RECETA MÉDICA</h1>
    <h2>Datos del Paciente</h2>
    <label >Paciente:</label>
        <input type="text" name="paciente" value="<?php echo $paciente; ?>" readonly>
        <label >Telefono:</label>
        <input type="text" name="telefono_paciente" value="<?php echo $telefono_paciente; ?>" readonly>
        <label >Hora:</label>
        <input type="text" name="hora_cita" value="<?php echo $hora_cita; ?>" readonly>
        <label >Fecha:</label>
        <input type="text" name="fecha_cita" value="<?php echo $fecha_cita; ?>" readonly>


        <input type="hidden" name="id_receta" value="<?php echo $id_receta; ?>" readonly>
        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>" readonly>
        
        <h2>Doctor</h2>
        <label >Doctor:</label>
        <input type="text" name="Doctor" value="<?php echo $Doctor; ?>" readonly> 
        <label >Telefono Doctor:</label>
        <input type="text" name="telefono_empleado" value="<?php echo $telefono_empleado; ?>" readonly>
        
       
        
     <h2>Cuerpo de la receta</h2>
      <input type="text" name="dosis_medicamento" placeholder="Dosis" value="<?php echo $dosis_medicamento; ?>" required>
      <input type="text" name="frecuencia_medicamento" placeholder="Frecuencia" value="<?php echo $frecuencia_medicamento; ?>" required>

      <label >Prueba a realizar:</label>
        <select name="id_prueba" id="" >
        <?php
        include("../conexion.php");
        $sql="select * from prueba_lab";
        $resultado=mysqli_query($conexion,$sql);
        while($row=mysqli_fetch_array($resultado)){
           // $id_empleado=$row['id_empleado'];   ////Para obtener el valor selecciuonadp
            $tipo_prueba=$row['tipo_prueba'];
            $nombre_prueba=$row['nombre_prueba'];
            $id_prueba=$row['id_prueba'];
            if($nombre_prueba==$nombre_prueba1){?>
                <option value="<?php echo $id_prueba;?>" selected><?php echo $nombre_prueba;?></option>
            <?php
            }else{?>
        
        <option value="<?php echo $id_prueba;?>"><?php echo $nombre_prueba;?></option>
        <?php
        } ///if
    } ///whilw
        ?>
       </select>
    
        <button type="submit" name="enviar">Guardar</button>
        <a href="index_recetas.php">Regresar</a>
    </section>
</body>
</html>