<?php
// Archivo index_sucursal, que muestra los registros de la sucursal
// asi como los botones CRUD y campos para la busqueda

// Se incluye la conexion a la base de datos
 include("../conexion.php");  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
    <!-- Se inicia un formulario con el metodo post y  la accion que cuando se envie, los datos seran 
    enviados en el mismo archivo, para realizar la busqueda de registros-->
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

    <!-- Se crea una tabla para poder visualizar los botones y campors de busqueda, regrersar y 
    nuevo registro-->
    <table>
        <tr>
            <th colspan="6"><h1>Sucursal</h1></th>
        </tr>
        <tr><td><a href="../index.php">Regresar</a></td>
            <td>
                
                <input type="text" name = 'id_sucursal' placeholder="Id">
            </td>
            <td>
                
                <input type="text" name = 'nombre_suc' placeholder="Nombre">
            </td>
            <td>
            <button type="submit" name="enviar">BUSCAR</button>
            </td>
            <td>
                <a href="index_sucursal.php">Mostrar todos</a>
            </td>
            <td><a href="agregar_sucursal.php">Nuevo</a></td>
        </tr>
        <tr></tr>
        <tr></tr>
    </table>

    </form>

    <!-- Se crea una tabla para poder visualizar los datos, asi como diferentes opciones
    CRUD-->
    <table>
    <thead> 
      <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Cuando se presiona el botón de enviar de la busqueda
        if(isset($_POST['enviar'])){
            // Se guardan los datos 
            $id_sucursal = $_POST['id_sucursal'];
            $nombre_suc = $_POST['nombre_suc'];

            // Se comprueba que la información de los campos no este vacia y se envia una alerta
            // dependiendo del caso

            // Si no se tiene información se envia una alerta
            if(empty($_POST['id_sucursal']) && empty($_POST['nombre_suc'])){
                echo "<script languaje = 'Javascript'>
                alert('Ingresa un valor a buscar');
                location.assign('index_sucursal.php');
                </script>
                ";

            // index_sucursal parte #2
            // De lo contrario se procede  a reaizar la consulta dependiendo de los campos llenados
            }else {
                if (empty($_POST['nombre_suc'])) {
                    $sql="SELECT * FROM sucursal where id_sucursal =" .$id_sucursal; 
                }
                if (empty($_POST['id_sucursal'])) {
                    $sql="SELECT * FROM sucursal where nombre_suc like '%" .$nombre_suc."%'";
                }
                if (!empty($_POST['id_sucursal']) && !empty($_POST['nombre_suc'])) {
                    $sql="SELECT * FROM sucursal whereid_sucursal =".$id_sucursal." and nombre_suc like '%".$nombre_suc."%'";
                
            }
            
            // Se ejecuta la consulta y se insertan los valores en la tabla por cada registro 
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
            <td><?php echo $filas['id_sucursal'] ?></td>
            <td><?php echo $filas['nombre_suc'] ?></td>
            <td><?php echo $filas['direccion_suc'] ?></td>
            <td><?php echo $filas['telefono_suc'] ?></td>
            <td>
            
            <!-- Botones CRUD -->
            <?php echo "<a href='editar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Editar</a>"; ?>
                &nbsp;
                <?php echo "<a href='eliminar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Eliminar</a>"; ?>
            </td>
        </tr>

    <?php
            }
        }
        // Si no se esta buscando se realiza una busqueda general
        }else{
            // Se crea la consulta, se ejecuta y se llenan los valores en la tabla
            $sql="SELECT * FROM sucursal";
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
        ?>
        <tr>
            <td><?php echo $filas['id_sucursal'] ?></td>
            <td><?php echo $filas['nombre_suc'] ?></td>
            <td><?php echo $filas['direccion_suc'] ?></td>
            <td><?php echo $filas['telefono_suc'] ?></td>
            <td>
            <?php echo "<a href=editar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Editar</a>"; ?>
                &nbsp;
                <?php echo "<a href='eliminar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Eliminar</a>"; ?>
            </td>
        </tr>
        <?php
            }
        }
        ?>
      </tbody>
    </table>

    
    <script type="text/javascript">
    // funcion para confirmar si se desea eliminar
    function confirmar(){
            return confirm('Estas seguro de eliminar');
        }
    </script>
</body>
</html>
