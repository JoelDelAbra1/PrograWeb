<?php
 include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
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
            <th colspan="6"><h1>Empleados</h1></th>
        </tr>
        <tr>
        <td><a href="../index.php">Regresar</a></td>
            <td>
                <input type="text" name = 'id_empleado' placeholder="Id">
            </td>
            <td>
             
                <input type="text" name = 'nombre' placeholder="Nombre">
            </td>
            <td>
            <button type="submit" name="enviar">BUSCAR</button>
            </td>
            <td>
                <a href="index_emp.php">Mostrar todos</a>
            </td>
            <td><a href="agregar_emp.php">Nuevo</a></td>
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
            <th>Ocupacion</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_POST['enviar'])){
            $id_empleado = $_POST['id_empleado'];
            $nombre = $_POST['nombre'];
            //$apellidos = $_POST['apellidos'];

            if(empty($_POST['id_empleado']) && empty($_POST['nombre'])){
                echo "<script languaje = 'Javascript'>
                alert('Ingresa un valor a buscar');
                location.assign('index_emp.php');
                </script>
                ";
            }else {
                if (empty($_POST['nombre'])) {
                    $sql="SELECT id_empleado, CONCAT(nombre_empleado,' ', apellido_paterno, ' ',apellido_materno) empleados,ocupacion_empleado , telefono_empleado FROM empleados  
                    where id_empleado =" .$id_empleado; 
                }
                if (empty($_POST['id_empleado'])) {
                    $sql="SELECT id_empleado, CONCAT(nombre_empleado,' ', apellido_paterno, ' ',apellido_materno) empleados, ocupacion_empleado ,telefono_empleado FROM empleados
                    where nombre_empleado like '%" .$nombre."%' or ocupacion_empleado like '%" .$nombre."%' or telefono_empleado like '%" .$nombre."%'";
                }
                if (!empty($_POST['id_empleado']) && !empty($_POST['nombre'])) {
                    $sql="SELECT id_empleado, CONCAT(nombre_empleado,' ', apellido_paterno, ' ',apellido_materno) empleados,ocupacion_empleado, telefono_empleado FROM empleados
                     where id_empleado =".$id_empleado." and nombre_empleado like '%".$nombre."%' or telefono_empleado like '%" .$nombre."%'";
                }
            }
            
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
            <td><?php echo $filas['id_empleado'] ?></td>
            <td><?php echo $filas['empleados'] ?></td>
            <td><?php echo $filas['ocupacion_empleado'] ?></td>
            <td><?php echo $filas['telefono_empleado'] ?></td>
            <td>
            <?php echo "<a href='editar_emp.php?id_empleado=".$filas['id_empleado']."'>Editar</a>"; ?>
            &nbsp;
                <?php echo "<a href='eliminar_emp.php?id_empleado=".$filas['id_empleado']."'>Eliminar</a>"; ?>
            </td>
        </tr>

    <?php
            }
        }else{
            $sql="SELECT id_empleado, CONCAT(nombre_empleado,' ', apellido_paterno, ' ',apellido_materno) empleados, telefono_empleado, ocupacion_empleado FROM empleados;";
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
        ?>
        <tr>
            <td><?php echo $filas['id_empleado'] ?></td>
            <td><?php echo $filas['empleados'] ?></td>
            <td><?php echo $filas['ocupacion_empleado'] ?></td>
            <td><?php echo $filas['telefono_empleado'] ?></td>
            <td>
            <?php echo "<a href='editar_emp.php?id_empleado=".$filas['id_empleado']."'>Editar</a>"; ?>
                &nbsp;
                <?php echo "<a href='eliminar_emp.php?id_empleado=".$filas['id_empleado']."'>Eliminar</a>"; ?>
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