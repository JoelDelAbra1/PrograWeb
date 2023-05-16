<?php

session_start(); // Continuar la sesion

$permiso_s = $_SESSION['permiso_id']; // Variables definidas al iniciar sesion
$id_empleado = $_SESSION['id_empleado'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <script type="text/javascript">
        function confirmar() {
            return confirm('Estas seguro de eliminar');
        }
    </script>

    <link rel="stylesheet" href="../estilos.css">
    <link rel="shortcut icon" href="../cabecera.jpg">

</head>

<body>


    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

        <table class="table table-dark table-striped">

            <tr>
                <th colspan="5">
                    <h1>Citas</h1>
                </th>
            </tr>



            <tr>
                <td><a href="../index.php">Regresar</a></td>



                </td>
                <td> <input type="text" name='id_cita' placeholder="Id"></td>
                <td>

                    <input type="text" name='nombre' placeholder="Nombre">
                </td>
            
                <td>
                    <button type="submit" name="enviar">BUSCAR</button>
                </td>


                <td>
                    <a href="index_citas.php">Mostrar todos</a>
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
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
      include("../conexion.php");  // conexion
      ?>
            <?php

        if (isset($_POST['enviar'])) {  // Si se pulsa el botón
            $id_cita = $_POST['id_cita'];
            $nombre = $_POST['nombre'];

    

            if (empty($_POST['nombre'])) {
                
                    if ($permiso_s != 2) {   /// Diferenciar entre los diferentes permisos
                        $sql = "SELECT * FROM v_citas  where id_cita =" . $id_cita;
                    } else{
                        $sql = "SELECT * FROM v_citas  where id_cita =" . $id_cita." and id_empleado=".$id_empleado;
                    }
            }
            if (empty($_POST['id_cita'])) {
                
                if ($permiso_s != 2) {
                    $sql = "SELECT * FROM v_citas  where paciente like '%" . $nombre . "%' or estado_cita like '%" . $nombre . "%'";
                } else{
                    $sql = "SELECT * FROM v_citas  where paciente like '%" . $nombre . "%' and id_empleado=".$id_empleado;
                }
            }
            if (!empty($_POST['id_cita']) && !empty($_POST['nombre'])) {
                
                if($permiso_s!=2){
                $sql = "SELECT * FROM v_citas  where id_cita =" . $id_cita . " and paciente like '%" . $nombre . "%'";
            } else {
                    $sql = "SELECT * FROM v_citas  where id_cita =" . $id_cita . " and paciente like '%" . $nombre . "%' and id_empleado =".$id_empleado;}
            }
               
            


            $resultado = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_assoc($resultado)) { ///Realiza la consulta de la busqueda cuando se precione
        ?>
            <tr>
                <td>
                    <?php echo $filas['id_cita'] ?>  <!-- Imprimir los valores -->
                </td>
                <td>
                    <?php echo $filas['paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['telefono_paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['doctor'] ?>
                </td>
                <td>
                    <?php echo $filas['fecha_cita'] ?>
                </td>
                <td>
                    <?php echo $filas['hora_cita'] ?>
                </td>
                <td>
                    <?php echo $filas['estado_cita'] ?>
                </td>
                <td>
                    <?php echo "<a href='editar_citas.php?id_cita=" . $filas['id_cita'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='eliminar_cita.php?id_cita=" . $filas['id_cita'] . "'>Eliminar</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='../receta/agregar_receta.php?id_cita=" . $filas['id_cita'] . "' >Generar Receta</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='../recibo/agregar_recibo.php?id_cita=" . $filas['id_cita'] . "'>Generar Recibo</a>"; ?>
                </td>
            </tr>

            <?php
            }
        } else { ///Asi se mostrara cuando entre o le de al boton de mostrar todos
            
            if ($permiso_s == 2) {
                $sql = "select * from v_citas where id_empleado =".$id_empleado;
                
            }else{ $sql = "select * from v_citas";}
            
            $resultado = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_assoc($resultado)) {

        ?>
            <tr>
                <td>
                    <?php echo $filas['id_cita'] ?>
                </td>
                <td>
                    <?php echo $filas['paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['telefono_paciente'] ?>
                </td>
                <td>
                    <?php echo $filas['fecha_cita'] ?>
                </td>
                <td>
                    <?php echo $filas['hora_cita'] ?>
                </td>
                <td>
                    <?php echo $filas['doctor'] ?>
                </td>
                <td>
                    <?php echo $filas['estado_cita'] ?>
                </td>
                <td>
                    <?php echo "<a href='editar_citas.php?id_cita=" . $filas['id_cita'] . "'>Editar</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='eliminar_cita.php?id_cita=" . $filas['id_cita'] . "'>Eliminar</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='../receta/agregar_receta.php?id_cita=" . $filas['id_cita'] . "' >Generar Receta</a>"; ?>
                    &nbsp;
                    <?php if ($permiso_s != 3)
                    echo "<a href='../recibo/agregar_recibo.php?id_cita=" . $filas['id_cita'] . "'>Generar Recibo</a>"; ?>
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