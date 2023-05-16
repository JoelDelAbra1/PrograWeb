<?php
$id_consultorio=$_GET['id_consultorio'];
include('../conexion.php');
$sql="delete from consultorio where id_consultorio = '".$id_consultorio."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_consultorio.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_consultorio.php');
            </script>";
}
?>