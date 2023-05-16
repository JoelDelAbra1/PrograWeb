<?php
$Id_paciente=$_GET['Id_paciente'];
include('../conexion.php');
$sql="delete from paciente where id_paciente = '".$Id_paciente."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_paciente.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_paciente.php');
            </script>";
}
?>