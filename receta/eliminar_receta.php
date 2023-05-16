<?php
$id_receta=$_GET['id_receta'];
include('../conexion.php');
$sql="delete from recetas where id_receta = '".$id_receta."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_recetas.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_recetas');
            </script>";
}
?>