<?php
// Archivo index_recibos, que muestra los registros de los recibos
// asi como los botones CRUD y campos para la busqueda

// Se incluye la conexion a la base de datos
include("../conexion.php");

// Se continua con la sesion ya iniciada y se recupera el permiso que tiene 
// el usuario
session_start();

$permiso_s = $_SESSION['permiso_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibos</title>

    <link rel="stylesheet" href="../estilos.css">
</head>

<body>
    <!-- Se inicia un formulario con el metodo post y  la accion que cuando se envie, los datos seran 
    enviados en el mismo archivo, para realizar la busqueda de registros-->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        
     <!-- Se crea una tabla para poder visualizar los botones y campors de busqueda, regrersar y 
    nuevo registro-->
    <table>
            <tr>
                <th colspan="5">
                    <h1>Recibos</h1>
                </th>
            </tr>
            <tr>
                <td><a href="../index.php">Regresar</a></td>
                <td>

                    <input type="text" name="id_recibo" placeholder="Id">
                </td>
                <td>

                    <input type="text" name='nombre' placeholder="Nombre">
                </td>
                <td>
                    <button type="submit" name="enviar">BUSCAR</button>
                </td>
                <td>
                    <a href="index_recibos.php">Mostrar todos</a>
                </td>
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
                <th>Paciente</th>
                <th>Telefono</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Costo</th>
                <th>Sucursal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Cuando se presiona el botón de enviar de la busqueda
            if (isset($_POST['enviar'])) {
                $id_recibo = $_POST['id_recibo'];
                $nombre = $_POST['nombre'];

            // Se comprueba que la información de los campos no este vacia y se envia una alerta
            // dependiendo del caso

            // Si no se tiene información se envia una alerta
            
                if (empty($_POST['id_recibo']) && empty($_POST['nombre'])) { /////Busqueda
                    echo "<script languaje = 'Javascript'>
                alert('Ingresa un valor a buscar');
                location.assign('index_recibos.php');
                </script>
                ";

                // De lo contrario se procede  a reaizar la consulta dependiendo de los campos llenados
                } else {
                    if (empty($_POST['nombre'])) {
                        $sql = "SELECT * FROM v_recibo  where id_recibo =" . $id_recibo;
                    }
                    if (empty($_POST['id_recibo'])) {
                        $sql = "SELECT * FROM v_recibo where paciente like '%" . $nombre . "%'";
                    }
                    if (!empty($_POST['id_recibo']) && !empty($_POST['nombre'])) {
                        $sql = "SELECT * FROM v_recibo where id_recibo =" . $id_recibo . " and paciente like '%" . $nombre . "%'";
                    }
                }

                // Index_recibos #2
                 // Se ejecuta la consulta y se insertan los valores en la tabla por cada registro
                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) { ///Realiza la consulta de la busqueda cuando se preciono
                    ?>
                    <tr>
                        <td>
                            <?php echo $filas['id_recibo'] ?>
                        </td>
                        <td>
                            <?php echo $filas['paciente'] ?>
                        </td>
                        <td>
                            <?php echo $filas['telefono_paciente'] ?>
                        </td>
                        <td>
                            <?php echo $filas['fecha_generacion'] ?>
                        </td>
                        <td>
                            <?php echo $filas['hora_generacion'] ?>
                        </td>
                        <td>
                            <?php echo $filas['costo'] ?>
                        </td>
                        <td>
                            <?php echo $filas['nombre_suc'] ?>
                        </td>

                        <!-- Botones CRUD -->
                        <td>
                            <?php if ($permiso_s != 3)
                                echo "<a href='editar_recibo.php?id_recibo=" . $filas['id_recibo'] . "'>Editar</a>"; ?>
                            &nbsp;
                            <?php if ($permiso_s != 3)
                                echo "<a href='eliminar_recibo.php?id_recibo=" . $filas['id_recibo'] . "'>Eliminar</a>"; ?>
                            &nbsp;
                            <?php echo "<a href='../imp_recibo.php?id_recibo=" . $filas['id_recibo'] . "' target='_blank'>Imprimir Recibo</a>"; ?>
                        </td>
                    </tr>

                    <?php
                }
            // Si no se esta buscando nada se realiza una busqueda general
            } else {
                // Se crea la consulta, se ejecuta y se llenan los valores en la tabla
                $sql = "SELECT * from v_recibo";

                $resultado = mysqli_query($conexion, $sql);
                while ($filas = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $filas['id_recibo'] ?>
                        </td>
                        <td>
                            <?php echo $filas['paciente'] ?>
                        </td>
                        <td>
                            <?php echo $filas['telefono_paciente'] ?>
                        </td>
                        <td>
                            <?php echo $filas['fecha_generacion'] ?>
                        </td>
                        <td>
                            <?php echo $filas['hora_generacion'] ?>
                        </td>
                        <td>
                            <?php echo $filas['costo'] ?>
                        </td>
                        <td>
                            <?php echo $filas['nombre_suc'] ?>
                        </td>
                        <td>
                            <?php if ($permiso_s != 3)
                                echo "<a href='editar_recibo.php?id_recibo=" . $filas['id_recibo'] . "'>Editar</a>"; ?>
                            &nbsp;
                            <?php if ($permiso_s != 3)
                                echo "<a href='eliminar_recibo.php?id_recibo=" . $filas['id_recibo'] . "'>Eliminar</a>"; ?>
                            &nbsp;
                            <?php echo "<a href='../imp_recibo.php?id_recibo=" . $filas['id_recibo'] . "' target='_blank'>Imprimir Recibo</a>"; ?>
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
        function confirmar() {
            return confirm('Estas seguro de eliminar');
        }
    </script>
</body>
</html>