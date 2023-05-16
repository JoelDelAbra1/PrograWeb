<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="shortcut icon" href="../cabecera.jpg">
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
        
        $nombre_paciente = $_POST['nombre_paciente'];
        $apellido_paterno = $_POST['Apellido_paterno'];
        $apellido_materno = $_POST['Apellido_materno'];
        $colonia_paciente = $_POST['colonia_paciente'];
        $calle_paciente = $_POST['calle_paciente'];
        $Telefono_paciente = $_POST['Telefono_paciente'];
        $fecha_nac = $_POST['fecha_nac'];
        $id_sucursal = $_POST['id_sucursal'];
        
        $sql="INSERT INTO paciente(nombre_paciente, apellido_paterno, 
        apellido_materno, colonia_paciente, calle_paciente, telefono_paciente, fecha_nac, id_sucursal) 
        VALUES ('$nombre_paciente', '$apellido_paterno', '$apellido_materno'
        , '$colonia_paciente', '$calle_paciente','$Telefono_paciente', '$fecha_nac', '$id_sucursal')";
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('index_paciente.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('index_paciente.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{

    }
    ?>
<form action="" method="POST">
    <h1>Agregar Paciente</h1>
        <input type="text" name="nombre_paciente" placeholder="Nombre" required>
        <input type="text" name="Apellido_paterno" placeholder="Apellido paterno" required>
        <input type="text" name="Apellido_materno" placeholder="Apellido Materno" required>
        <input type="text" name="colonia_paciente" placeholder="Colonia" required>
        <input type="text" name="calle_paciente" placeholder="Calle" required>
        <input type="tel" name="Telefono_paciente" placeholder="Teléfono (10 digitos)" pattern="[0-9]{10}" required>
        <label for="">Fecha de Nacimineto</label>
        <input type="date" name="fecha_nac" placeholder="Fecha de Nacimineto" required>
        <label for="">Sucursal:</label>
        <select name="id_sucursal" id="">
       
        <?php
        include("../conexion.php");
        $sql="select * from sucursal";
        $resultado=mysqli_query($conexion,$sql);
        while($row=mysqli_fetch_array($resultado)){
           // $id_empleado=$row['id_empleado'];
            $id_sucursal=$row['id_sucursal'];
            $direccion_suc=$row['direccion_suc'];
            
        ?>
        <option value="<?php echo $id_sucursal;?>"><?php echo $direccion_suc;?></option>
        <?php
        
        }
        
        ?>
        
       </select>
        <button type="submit" name="enviar">Enviar</button>
        <a href="index_paciente.php">Regresar</a>
    </section>
</body>
</html>