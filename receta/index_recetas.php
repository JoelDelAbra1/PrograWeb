<?php
 include("../conexion.php");
 session_start();

 $permiso_s = $_SESSION['permiso_id'];
 $id_empleado = $_SESSION['id_empleado'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas</title>
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
            <th colspan="5"><h1>Recetas</h1></th>
        </tr>
        <tr>
        <td><a href="../index.php">Regresar</a></td>
            <td>
                
                <input type="text" name = 'id_receta' placeholder="Id">
            </td>
            <td>
                <input type="text" name = 'nombre' placeholder="Nombre">
            </td>
            <td>
            <button type="submit" name="enviar">BUSCAR</button>
            </td>
            <td>
                <a href="index_recetas.php">Mostrar todos</a>
            </td>
           
            
        </tr>
        <tr></tr>
        <tr></tr>
    </table>

    </form>

    <table>
    <thead> 
      <tr>
            <th>Id</th>
            <th>Paciente</th>
            <th>Telefono</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Doctor</th>
            <th>Sucursal</th>
            <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_POST['enviar'])){
            $id_receta = $_POST['id_receta'];
            $nombre = $_POST['nombre'];
            //$apellidos = $_POST['apellidos'];

            if(empty($_POST['id_receta']) && empty($_POST['nombre'])){ /////Busqueda
                echo "<script languaje = 'Javascript'>
                alert('Ingresa un valor a buscar');
                location.assign('index_recetas.php');
                </script>
                ";
            }else {
                if (empty($_POST['nombre'])) {
                    if($permiso_s != 2){
                        $sql="SELECT * FROM v_receta  where id_receta =" .$id_receta;
                    }else{
                    $sql="SELECT * FROM v_receta  where id_receta =" .$id_receta." and id_empleado=".$id_empleado; 
               } 
            }
                if (empty($_POST['id_receta'])) {
                    if ($permiso_s != 2) { 
                        $sql="SELECT * FROM v_receta  where paciente like '%" .$nombre."%'";
                    }else{
                         $sql="SELECT * FROM v_receta  where paciente like '%" .$nombre."%' and id_empleado=".$id_empleado;
                    }
                   
                }
                if (!empty($_POST['id_receta']) && !empty($_POST['nombre'])) {
                    if ($permiso_s != 2) {
                        $sql = "SELECT * FROM v_receta  where id_receta =" . $id_receta . " and paciente like '%" . $nombre . "%'";
                    }else{
                         $sql = "SELECT * FROM v_receta  where id_receta =" . $id_receta . " and paciente like '%" . $nombre . "%' and id_empleado=".$id_empleado;
                    }
            } 
        }
            
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){ ///Realiza la consulta de la busqueda cuando se preciono
                $id_cita = $filas['id_cita'];
                ?>
                <tr>
                <td><?php echo $filas['id_receta'] ?></td>
            <td><?php echo $filas['paciente'] ?></td>
            <td><?php echo $filas['telefono_paciente'] ?></td>
            <td><?php echo $filas['fecha_cita'] ?></td>
            <td><?php echo $filas['hora_cita'] ?></td>
            <td><?php echo $filas['Doctor'] ?></td>
            <td><?php echo $filas['nombre_suc']?></td>
            <td>
            <?php if($permiso_s!=3) echo "<a href='editar_receta.php?id_receta=".$filas['id_receta']."'>Editar</a>"; ?>
                &nbsp;
                <?php if($permiso_s!=3)echo "<a href='eliminar_receta.php?id_receta=".$filas['id_receta']."'>Eliminar</a>"; ?>
                &nbsp;
                <?php echo "<a href='../index1.php?id_cita=".$id_cita."' target='_blank'>Imprimir Receta</a>"; ?>
            </td>
        </tr>

    <?php
            }
        }else{  ///Asi se mostrara cuando entre o le de al boton de mostrar todos
            if($permiso_s==2){
                $sql="SELECT * from v_receta where id_empleado = '".$id_empleado."' order by id_receta" ;
            }else{
              $sql="SELECT * from v_receta order by id_receta" ;  
            }
            
            
            $resultado=mysqli_query($conexion,$sql);
            while($filas=mysqli_fetch_assoc($resultado)){
                $id_receta = $filas['id_receta'];
                $id_cita = $filas['id_cita'];
        ?>
        <tr>
            <td><?php echo $filas['id_receta'] ?></td>
            <td><?php echo $filas['paciente'] ?></td>
            <td><?php echo $filas['telefono_paciente'] ?></td>
            <td><?php echo $filas['fecha_cita'] ?></td>
            <td><?php echo $filas['hora_cita'] ?></td>
            <td><?php echo $filas['Doctor'] ?></td>
            <td><?php echo $filas['nombre_suc']?></td>
            <td>
            <?php if($permiso_s!=3) echo "<a href='editar_receta.php?id_receta=".$filas['id_receta']."'>Editar</a>"; ?>
                &nbsp;
                <?php if($permiso_s!=3)echo "<a href='eliminar_receta.php?id_receta=".$filas['id_receta']."'>Eliminar</a>"; ?>
                &nbsp;
                <?php echo "<a href='../index1.php?id_cita=".$id_cita."' target='_blank'>Imprimir Receta</a>"; ?>
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