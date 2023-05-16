<?php
// Archivo eliminar_recibo.php
// Se obtiene el id mediante el metodo GET 
$id_recibo=$_GET['id_recibo'];  

// Se incluye la conexion a la base de datos
include('../conexion.php');

// Se crea la consulta SQL
$sql="delete from recibo where id_recibo = '".$id_recibo."'";   

// Se ejecuta la consulta SQL
$resultado = mysqli_query($conexion,$sql);

// Si si se completa la cnsulta se envia una alerta de exito y se 
//redirecciona a la pagina de inicial de la seccion

if($resultado){
    echo" <script languaje = 'JavaScript'>
            alert('Los datos fueron eliminados');
            location.assign('index_recibos.php');
            </script>";
// De lo contrario se envia un mensaje de error y se redirecciona 
// a la pagina de inicial de la seccion

 }else{
    echo" <script languaje = 'JavaScript'>
            alert('ERROR: Los datos NO fueron eliminados');
            location.assign('index_recibos.php');
            </script>";
}
?>