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
        
        $id_cita = $_GET['id_cita'];
        $id_doctor = $_POST['doctor'];
        $id_paciente = $_POST['id_paciente'];
        $hora_cita = $_POST['hora_cita'];
        $fecha_cita = $_POST['fecha_cita'];
        
        
        $sql="update cita set id_doctor= '$id_doctor',hora_cita = '$hora_cita',fecha_cita ='$fecha_cita' 
        where id_cita=".$id_cita;
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_citas.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_citas.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{

        $id_cita=$_GET['id_cita'];
        $sql="select * from v_citas where id_cita = '".$id_cita."'";
        $resultado = mysqli_query($conexion,$sql);

        $fila= mysqli_fetch_assoc($resultado);
        $id_paciente= $fila["id_paciente"];
        
        $hora_cita = $fila["hora_cita"];
        $fecha_cita = $fila["fecha_cita"]; 
        $id_doctor1=$fila['id_doctor'];
        

        
        $sql="select * from paciente where id_paciente = '".$id_paciente."'";
        $resultado = mysqli_query($conexion,$sql);

        $fila= mysqli_fetch_assoc($resultado);
        $id_paciente= $fila["id_paciente"];
        $nombre_paciente= $fila["nombre_paciente"];
        $Apellido_paterno=$fila["apellido_paterno"];
        $Apellido_materno=$fila["apellido_materno"];
        mysqli_close($conexion);
    }
    ?>
<form action="" method="POST">
    <h1>Agendar Cita</h1>
        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
        <label for="">Nombre:</label>
      <input type="text" readonly name="nombre_paciente" value="<?php echo $nombre_paciente; ?>">
      <label for="">Apellido Paterno:</label>
      <input type="text" readonly name="apellido_paterno" value="<?php echo $Apellido_paterno; ?>">
      <label for="">Apellido Materno:</label>
      <input type="text" readonly name="apellido_materno" value="<?php echo $Apellido_materno; ?>">
      <label for="">Fecha:</label>
        <input type="date" name="fecha_cita" placeholder="Fecha_cita" value="<?php echo $fecha_cita; ?>" >    
      <label for="">Hora:</label>
      <input type="time" name="hora_cita" placeholder="Hora_cita" value="<?php echo $hora_cita; ?>">
      
        <label for="">Doctor</label>
        <select name="doctor" id="">
       
       <?php
       include("../conexion.php");
       $sql="SELECT * from v_doctores";
       $resultado=mysqli_query($conexion,$sql);
       while($row=mysqli_fetch_array($resultado)){
          // $id_empleado=$row['id_empleado'];
           
           $id_doctor=$row['id_doctor'];
           $nombre_doc=$row['nombre_doc'];
           if($id_doctor==$id_doctor1){?>
       <option value="<?php echo $id_doctor;?>" selected><?php echo $nombre_doc;?></option>
       <?php
       
       }else{?>
       <option value="<?php echo $id_doctor;?>"><?php echo $nombre_doc;?></option>
      <?php
       }
    }
    ?>
    </select>
    
       <button type="submit" name="enviar">Enviar</button>
        <a href="index_citas.php">Regresar</a>
    </section>
</body>
</html>