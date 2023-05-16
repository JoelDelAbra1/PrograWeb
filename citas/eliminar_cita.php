<?php
$id_cita=$_GET['id_cita']; //eliminar
include('../conexion.php');
$sql="delete from  cita where id_cita = '".$id_cita."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_citas.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_citas');
            </script>";
}
?>