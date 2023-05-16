<?php
$id_sucursal=$_GET['id_sucursal'];
include('../conexion.php');
$sql="delete from sucursal where id_sucursal = '".$id_sucursal."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_sucursal.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_sucursal.php');
            </script>";
}
?>