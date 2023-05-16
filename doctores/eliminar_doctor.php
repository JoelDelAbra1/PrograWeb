<?php
$id_doctor=$_GET['id_doctor'];
include('../conexion.php');
$sql="delete from doctor where id_doctor = '".$id_doctor."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_doctor.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_doctor.php');
            </script>";
}
?>