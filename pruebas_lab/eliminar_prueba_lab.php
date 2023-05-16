<?php
$id_prueba=$_GET['id_prueba'];
include('../conexion.php');
$sql="delete from prueba_lab where id_prueba = '".$id_prueba."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_prueba_lab.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_prueba_lab.php');
            </script>";
}
?>