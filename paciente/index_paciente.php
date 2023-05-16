<?php
include("../conexion.php");
session_start();

$permiso_s=$_SESSION['permiso_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
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
                    <h1>Pacientes</h1>
                </th>
            </tr>
            <tr>
                <td><a href="../index.php">Regresar</a></td>
                <td>
                    
                    <input type="text" name='Id_paciente' placeholder="Id">
                </td>
                <td>
                    
                    <input type="text" name='nombre' placeholder="Nombre">
                </td>
                <td>
                <button type="submit" name="enviar">BUSCAR</button>
                </td>
                <td>
                    <a href="index_paciente.php">Mostrar todos</a>
                </td>
                <td><a href="agregar_pac.php">Nuevo</a></td>
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
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['enviar'])) {
                $Id_paciente = $_POST['Id_paciente'];
                $nombre = $_POST['nombre'];
                //$apellidos = $_POST['apellidos'];
            
                if (empty($_POST['Id_paciente']) && empty($_POST['nombre'])) {
                    echo "<script languaje = 'Javascript'>
                    alert('Ingresa un valor a buscar');
                location.assign('index.php');
                </script>
                ";
                } else {
                    if (empty($_POST['nombre'])) {
                        $sql = "SELECT Id_paciente, CONCAT(nombre_paciente,' ', Apellido_paterno, ' ',Apellido_materno) Paciente, Telefono_paciente FROM paciente  where Id_paciente =" . $Id_paciente;
                    }
                    if (empty($_POST['Id_paciente'])) {
                        $sql = "SELECT Id_paciente, CONCAT(nombre_paciente,' ', Apellido_paterno, ' ',Apellido_materno) Paciente, Telefono_paciente FROM paciente  where nombre_paciente like '%" . $nombre . "%'";
                    }
                    if (!empty($_POST['Id_paciente']) && !empty($_POST['nombre'])) {
                        $sql = "SELECT Id_paciente, CONCAT(nombre_paciente,' ', Apellido_paterno, ' ',Apellido_materno) Paciente, Telefono_paciente FROM paciente where Id_paciente =" . $Id_paciente . " and nombre_paciente like '%" . $nombre . "%'";
                    }
                }

                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
            <tr>
                <td>
                    <?php echo $filas['Id_paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['Paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['Telefono_paciente'] ?>
                </td>
                <td>
                    <?php echo "<a href='editar_pac.php?Id_paciente=" . $filas['Id_paciente'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php  if($permiso_s != 3) echo "<a href='eliminar_pac.php?Id_paciente=" . $filas['Id_paciente'] . "'>Eliminar</a>"; ?>
                </td>
            </tr>

            <?php
                } 
            } else {
                $sql = "SELECT Id_paciente, CONCAT(nombre_paciente,' ', Apellido_paterno, ' ',Apellido_materno) Paciente,
                 Telefono_paciente FROM paciente;";
                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
            <tr>
                <td>
                    <?php echo $filas['Id_paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['Paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['Telefono_paciente'] ?>
                </td>
                <td>
                    <?php echo "<a href=editar_pac.php?Id_paciente=" . $filas['Id_paciente'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php if($permiso_s != 3) echo "<a href='eliminar_pac.php?Id_paciente=" . $filas['Id_paciente'] . "'>Eliminar</a>"; ?>
                    &nbsp;
                    <?php echo "<a href='../citas/agregar_citas.php?Id_paciente=" . $filas['Id_paciente'] . "'>Agendar Cita</a>"; ?>
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