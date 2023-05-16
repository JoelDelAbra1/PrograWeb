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
    // Verificar si se ha enviado el formulario
    if(isset($_POST['enviar'])){ //Si se presiona el boton enviar
            include("../conexion.php");// Se incluye el archivo de conexión a la base de datos 

        $id_doctor = $_POST['doctor'];
        $id_paciente = $_POST['id_paciente'];
        $hora_cita = $_POST['hora_cita'];
        $fecha_cita = $_POST['fecha_cita'];
        
        
        $sql="INSERT INTO cita(id_doctor,id_paciente,hora_cita,fecha_cita) 
        VALUES ( '$id_doctor', '$id_paciente'
        , '$hora_cita', '$fecha_cita')";
        $resultado = mysqli_query($conexion,$sql);
        //Se verificar si la inserción fue exitosa
        if($resultado){
            //Si es exitosa, se muestra un mensaje de éxito y se redirige a la página principal de paciente
            echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron guardados');
            location.assign('../paciente/index_paciente.php');
            </script>";
        }else{
            //Si falla, se muestra un mensaje de error y se redirige a la página principal de paciente
            echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron guardados');
            location.assign('../paciente/index_paciente.php');
            </script>";
        }
            //Se cierra la conexion a la base de datos
        mysqli_close($conexion);
        //Si no se ha presionado el boton de enviar
    }else{// Se van a recuperar los datos y mostrarlos en los input
        $id_paciente=$_GET['Id_paciente'];
        //Se crea y se ejecuta la consulta
        $sql="select * from paciente where id_paciente = '".$id_paciente."'";
        $resultado = mysqli_query($conexion,$sql);
        // Se asigna el array asosiativo a la variable fila
        $fila= mysqli_fetch_assoc($resultado);
        //La variable fila se asigna a los valores que se mostraran automaticamente
        // al querer agregar un nuevo registro
        $id_paciente= $fila["id_paciente"];
        $nombre_paciente= $fila["nombre_paciente"];
        $Apellido_paterno=$fila["apellido_paterno"];
        $Apellido_materno=$fila["apellido_materno"];
        mysqli_close($conexion);
    }
    ?>
    <!-- Estructura del formulario para agregar una nueva cita-->
<form action="" method="POST">
    <h1>Agendar Cita</h1>
        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
        <label for="">Nombre:</label>
            <!-- Campo de entrada de texto para el nombre del paciente-->
            <input type="text" readonly name="nombre_paciente" value="<?php echo $nombre_paciente; ?>">
      <label for="">Apellido Paterno:</label>
            <!-- Campo de entrada de texto para el apellido paterno del paciente-->
            <input type="text" readonly name="apellido_paterno" value="<?php echo $Apellido_paterno; ?>">
      <label for="">Apellido Materno:</label>
            <!-- Campo de entrada de texto para el apellido materno del paciente-->
            <input type="text" readonly name="apellido_materno" value="<?php echo $Apellido_materno; ?>">
            <!-- Campo de entrada de tiempo para la hora de la cita-->
      <input type="time" name="hora_cita" placeholder="Hora_cita">
            <!-- Campo de entrada de fecha para el dia de la cita-->
        <input type="date" name="fecha_cita" placeholder="Fecha_cita" >
        <label for="">Doctor</label>
        <select name="doctor" id="">
        <?php
        include("../conexion.php");
        $sql="Select * from v_doctores ";
        $resultado=mysqli_query($conexion,$sql);
        while($row=mysqli_fetch_array($resultado)){
           // $id_empleado=$row['id_empleado'];
            $nombre_doc=$row['nombre_doc'];
            $id_doctor=$row['id_doctor'];
        ?>
        <option value="<?php echo $id_doctor;?>"><?php echo $nombre_doc;?></option>
        <?php
        }
        ?>
       </select>
        <!-- Botón de envío del formulario -->
       <button type="submit" name="enviar">Enviar</button>
       <!-- Enlace para regresar a la pagina inicial de paciente-->
        <a href="../paciente/index_paciente.php">Regresar</a>
    </section>
</body>
</html>