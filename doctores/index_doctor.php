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
    <title>Doctores</title>
    <script type="text/javascript">
        function confirmar() {
            return confirm('Estas seguro de eliminar');
        }
    </script>
    <link rel="stylesheet" href="../estilos.css">

</head>

<body>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

        <table>

            <tr>
                <th colspan="6">
                    <h1>Doctores</h1>
                </th>
            </tr>
            <tr>
                <td><a href="../index.php">Regresar</a></td>
                <td>
                    <input type="text" name='id_doctor' placeholder="Id">
                </td>
                <td>
                    <input type="text" name='nombre_doc' placeholder="Nombre">
                </td>
                <td>
                    <button type="submit" name="enviar">BUSCAR</button>
                </td>
                <td>
                    <a href="index_doctor.php">Mostrar todos</a>
                </td>
                <td><?php if($permiso_s==1)echo'<a href="agregar_doctor.php">Nuevo</a>'?></td>
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
                <th>Consultorio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['enviar'])) {
                $id_doctor = $_POST['id_doctor'];
                $nombre_doc = $_POST['nombre_doc'];
                //$apellidos = $_POST['apellidos'];
            
                if (empty($_POST['id_doctor']) && empty($_POST['nombre_doc'])) {
                    echo "<script languaje = 'Javascript'>
                    alert('Ingresa un valor a buscar');
                    location.assign('index_doctor.php');
                    </script>
                    ";
                } elseif($permiso_s!=2) {
                    if (empty($_POST['nombre_doc'])) {
                        
                        $sql = "SELECT * FROM v_doctores where id_doctor =" . $id_doctor;
                    }
                    if (empty($_POST['id_doctor'])) {
                        $sql = "SELECT * FROM v_doctores  where nombre_doc like '%" . $nombre_doc . "%'" ;
                    }
                    if (!empty($_POST['id_doctor']) && !empty($_POST['nombre_doc'])) {
                        $sql = "SELECT * FROM v_doctores where id_doctor =" . $id_doctor . " and nombre_doc like '%" . $nombre_doc . "%'";
                    }
                }
               

                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
            <tr>

                <td>
                    <?php echo $filas['id_doctor'] ?>
                </td>
                <td>
                    <?php echo $filas['nombre_doc'] ?>
                </td>
                <td>
                    <?php echo $filas['num_consultorio'] ?>
                </td>
                <td>
                    <?php  if($permiso_s!=3)echo "<a href='editar_doctor.php?id_doctor=" . $filas['id_doctor'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php  if($permiso_s==1) echo "<a href='eliminar_doctor.php?id_doctor=" . $filas['id_doctor'] . "'>Eliminar</a>"; ?>
                </td>
            </tr>

            <?php
                }
            } else {
                if($permiso_s==2){$sql = "SELECT * from v_doctores where id_empleado=".$id_empleado;
                }else{
                    $sql = "SELECT * from v_doctores";
                }
                
                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
            <tr>
                <td>
                    <?php echo $filas['id_doctor'] ?>
                </td>
                <td>
                    <?php echo $filas['nombre_doc'] ?>
                </td>
                <td>
                    <?php echo $filas['num_consultorio'] ?>
                </td>


                <td>
                    <?php if($permiso_s!=3) echo "<a href='editar_doctor.php?id_doctor=" . $filas['id_doctor'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php if($permiso_s==1) echo "<a href='eliminar_doctor.php?id_doctor=" . $filas['id_doctor'] . "'>Eliminar</a>"; ?>
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