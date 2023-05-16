<?php
 include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pruebas de Laboratorio</title>
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
                <th colspan="6"><h1>Pruebas de Laboratorio</h1></th>
            </tr>
            <tr><td><a href="../index.php">Regresar</a></td>
                <td>
                    
                    <input type="text" name = 'id_prueba' placeholder="Id">
                </td>
                <td>
                    <input type="text" name = 'nombre_prueba' placeholder="Nombre">
                </td>
                <td>
                <button type="submit" name="enviar">BUSCAR</button>
                </td>
                <td>
                    <a href="index_prueba_lab.php">Mostrar todos</a>
                </td>
                <td><a href="agregar_pruebas_lab.php">Nuevo</a></td>
            </tr>
            <tr></tr>
            <tr></tr>
        </table>

        </form>

        <table>
        <thead> 
        <tr>
                <th>Id</th>
                <th>Nombre de la prueba</th>
                <th>Tipo de prueba</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_POST['enviar'])){
                $id_prueba = $_POST['id_prueba'];
                $nombre_prueba = $_POST['nombre_prueba'];
                //$apellidos = $_POST['apellidos'];

                if(empty($_POST['id_prueba']) && empty($_POST['nombre_prueba'])){
                    echo "<script languaje = 'Javascript'>
                    alert('Ingresa un valor a buscar');
                    location.assign('index_prueba_lab.php');
                    </script>
                    ";
                }else {
                    if (empty($_POST['nombre_prueba'])) {
                        $sql="SELECT id_prueba,  nombre_prueba, tipo_prueba FROM prueba_lab where id_prueba =" .$id_prueba; 
                    }
                    if (empty($_POST['id_prueba'])) {
                        $sql="SELECT id_prueba, nombre_prueba,tipo_prueba FROM prueba_lab  where nombre_prueba like '%" .$nombre_prueba."%'";
                    }
                    if (!empty($_POST['id_prueba']) && !empty($_POST['nombre_prueba'])) {
                        $sql="SELECT id_prueba,nombre_prueba, tipo_prueba FROM prueba_lab where id_prueba =".$id_prueba." and nombre_prueba like '%".$nombre_prueba."%'";
                    }
                }
                
                $resultado=mysqli_query($conexion,$sql);
                while($filas=mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                <td><?php echo $filas['id_prueba'] ?></td>
                <td><?php echo $filas['nombre_prueba'] ?></td>
                <td><?php echo $filas['tipo_prueba'] ?></td>
                
                <td>
                <?php echo "<a href='editar_prueba_lab.php?id_prueba=".$filas['id_prueba']."'>Editar</a>"; ?>
                    &nbsp;
                    <?php echo "<a href='eliminar_prueba_lab.php?id_prueba=".$filas['id_prueba']."'>Eliminar</a>"; ?>
                </td>
            </tr>

        <?php
                }
            }else{
                $sql="SELECT id_prueba,tipo_prueba, nombre_prueba  FROM prueba_lab;";
                $resultado=mysqli_query($conexion,$sql);
                while($filas=mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
                <td><?php echo $filas['id_prueba'] ?></td>
                <td><?php echo $filas['nombre_prueba'] ?></td>
                <td><?php echo $filas['tipo_prueba'] ?></td>
                
                
                <td>
                <?php echo "<a href='editar_prueba_lab.php?id_prueba=".$filas['id_prueba']."'>Editar</a>"; ?>
                    &nbsp;
                    <?php echo "<a href='eliminar_prueba_lab.php?id_prueba=".$filas['id_prueba']."'>Eliminar</a>"; ?>
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