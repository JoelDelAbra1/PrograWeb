<?php
$id_recibo=$_GET['id_recibo'];
include('../conexion.php');
$sql="delete from recibo where id_recibo = '".$id_recibo."'";
$resultado = mysqli_query($conexion,$sql);
if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_recibos.php');
            </script>";
}else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_recibos.php');
            </script>";
}
?>