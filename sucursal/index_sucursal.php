<?php
 include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <script type="text/javascript">
        function confirmar(){
            return confirm('Estas seguro de eliminar');
        }
    </script>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>

    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

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
        if(isset($_POST['enviar'])){
            $id_sucursal = $_POST['id_sucursal'];
            $nombre_suc = $_POST['nombre_suc'];
            //$apellidos = $_POST['apellidos'];

            if(empty($_POST['id_sucursal']) && empty($_POST['nombre_suc'])){
                echo "<script languaje = 'Javascript'>
                alert('Ingresa un valor a buscar');
                location.assign('index_sucursal.php');
                </script>
                ";
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
            
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
            <td><?php echo $filas['id_sucursal'] ?></td>
            <td><?php echo $filas['nombre_suc'] ?></td>
            <td><?php echo $filas['direccion_suc'] ?></td>
            <td><?php echo $filas['telefono_suc'] ?></td>
            <td>
            <?php echo "<a href='editar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Editar</a>"; ?>
                &nbsp;
                <?php echo "<a href='eliminar_sucursal.php?id_sucursal=".$filas['id_sucursal']."'>Eliminar</a>"; ?>
            </td>
        </tr>

    <?php
            }
        }

        }else{
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
</body>
</html>
