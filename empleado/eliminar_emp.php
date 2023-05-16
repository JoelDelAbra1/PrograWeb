<?php
$id_empleado=$_GET['id_empleado'];
include('../conexion.php');
$sql="delete from empleados where id_empleado = '".$id_empleado."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_emp.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_emp.php');
            </script>";
}
?>