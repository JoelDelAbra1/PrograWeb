<?php
$permiso_id=$_GET['permiso_id'];
include('../conexion.php');
$sql="delete from t_permiso where permiso_id = '".$permiso_id."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_t_permisos.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_t_permiso.php');
            </script>";
}
?>