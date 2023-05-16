<?php
include("../conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
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
    if(isset($_POST['enviar'])){

        $nombre_paciente = $_POST['nombre_paciente'];
        $apellido_paterno = $_POST['Apellido_paterno'];
        $apellido_materno = $_POST['Apellido_materno'];
        $colonia_paciente = $_POST['colonia_paciente'];
        $calle_paciente = $_POST['calle_paciente'];
        $telefono_paciente = $_POST['Telefono_paciente'];
        $fecha_nac = $_POST['fecha_nac'];
$id_paciente= $_POST['id_paciente'];
      
    ////////////////////////////no jalaaa
        $sql="update paciente set nombre_paciente='".$nombre_paciente."',apellido_paterno='".$apellido_paterno."',apellido_materno='".$apellido_materno."' 
        ,colonia_paciente='".$colonia_paciente."' ,calle_paciente='".$calle_paciente."',telefono_paciente='".$telefono_paciente."' ,
        fecha_nac='".$fecha_nac."'where id_paciente='".$id_paciente."'";
        $resultado = mysqli_query($conexion,$sql);
        if($resultado){
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron actualizados');
            location.assign('index_paciente.php');
            </script>";
        }else{
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron actualizados');
            location.assign('index_paciente.php');
            </script>";
        }
        mysqli_close($conexion);
    }else{

        $id_paciente=$_GET['Id_paciente']; //recupera el valor del otro
        $sql='SELECT * FROM paciente WHERE id_paciente="'.$id_paciente.'"';
        $resultado = mysqli_query($conexion,$sql);

        $fila= mysqli_fetch_assoc($resultado);
        
        $id_paciente= $fila["id_paciente"];
        $nombre_paciente= $fila["nombre_paciente"];
        $apellido_paterno=$fila["apellido_paterno"];
        $apellido_materno=$fila["apellido_materno"];
        $colonia_paciente=$fila["colonia_paciente"];
        $calle_paciente=$fila["calle_paciente"];
        $telefono_paciente=$fila["telefono_paciente"];
        $fecha_nac = $fila['fecha_nac'];
        

        mysqli_close($conexion);
    
    ?>
    <h1>Editar Paciente</h1>
    <form action="" method="post">
    <input type="Hidden" name="id_paciente" placeholder="Id" value="<?php echo $id_paciente; ?>" required> <br>
    <label for="">Nombre:</label>
    <input type="text" name="nombre_paciente" placeholder="Nombre" value="<?php echo $nombre_paciente; ?>" required> <br>
    <label for="">Apellido Paterno:</label>
        <input type="text" name="Apellido_paterno" placeholder="Apellido paterno" value="<?php echo $apellido_paterno; ?>" required> <br>
        <label for="">Apellido Materno:</label>
        <input type="text" name="Apellido_materno" placeholder="Apellido Materno" value="<?php echo $apellido_materno; ?>" required>  <br>
        <label for="">Colonia:</label>
        <input type="text" name="colonia_paciente" placeholder="Colonia" value="<?php echo $colonia_paciente; ?>" required> <br>
        <label for="">Calle:</label>
        <input type="text" name="calle_paciente" placeholder="Calle" value="<?php echo $calle_paciente; ?>" required> <br>
        <label for="">Teléfono:</label>
        <input type="tel" name="Telefono_paciente" placeholder="Teléfono" value="<?php echo $telefono_paciente; ?>" required> <br>
        <label for="">Fecha de Nacimineto</label>
        <input type="date" name="fecha_nac" placeholder="Fecha de Nacimineto" value="<?php echo $fecha_nac; ?>" required>
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
        </form>
    <?php
    } 
    ?>
     </section>
</body>
</html>