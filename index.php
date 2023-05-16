<?php

// Archivo index.php, donde se encuentra el mene general
// Se incluye el archivo de la conexion y se inicia la sesion para poder acceder a los datos
include("conexion.php");
session_start();

// Se guardan los permisos del usuario que tenga la sesion iniciada
$permiso_s = $_SESSION['permiso_id'];
?>
<html>

<head>
  <link rel="shortcut icon" href="cabecera.jpg">
  <title>Medicals Monterrey</title>
</head>
<link rel="stylesheet" href="styles.css">
</head>

<body background="fondo1.jpg">
  <table width="100%">

    <tr>
      <td></td>
      <td align="center"><img src="cabecera.jpg" height="250"></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td align="center" width="70%" height="100%">
        <marquee bgcolor="white" behavior="alternate" direction="right">
          <font color="black" size="35" face="monospace"><b>"Salvando Regios"</b>
      </td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <?php

      //Segun los permisos que se tengan se tendran diferentes menus a los que se puedan acceder
      if ($permiso_s == 1) { // Permisos del rol administrador
        echo '
          <td><table><tr><td><ul class="nav">
            <li><a href="citas/index_citas.php">Citas</a></li>
            <li><a href="sucursal/index_sucursal.php">Sucursales</a>
            <li><a href="consultorio/index_consultorio.php">Consultorios</a>
		        <li><a href="doctores/index_doctor.php">Doctores</a>
				    <li><a href="empleado/index_emp.php">Empleados</a></li>
            <li><a href="paciente/index_paciente.php">Pacientes</a></li>
            <li><a href="permisos/index_t_permisos.php">Privilegios</a></li>
					  <li><a href="pruebas_lab/index_prueba_lab.php">Pruebras De Laboratorio</a></li>
					  <li><a href="receta/index_recetas.php">Recetas</a></li>
					  <li><a href="recibo/index_recibos.php">Recibos</a></li>
            <li><a href="cerrarSesion.php">Cerrar Sesion</a></li>
		      </td>
		<td width="100%" bgcolor="20F7BC" align="center"><font color="black" size="6">
    Salvando </font><font color="blue" size="6"> Regios</font><br>
		</td>
 </table> ';
      } elseif ($permiso_s == 2 || $permiso_s == 3) { // doctor o Secretaria
      
        echo "
          <td>
          <table>
          <tr>
          <td>
           <ul class='nav'>
                   <li><a href='citas/index_citas.php'>Citas</a></li>                          
                     <li><a href='paciente/index_paciente.php'>Pacientes</a></li>
                     <li><a href='doctores/index_doctor.php'>Doctores</a>
					           <li><a href='receta/index_recetas.php'>Recetas</a></li>
					           <li><a href='recibo/index_recibos.php'>Recibos</a></li> 
                    <li><a href='cerrarSesion.php'>Cerrar Sesion</a></li>
                    </td>
		<td width='100%' bgcolor='20F7BC' align='center'><font color='black' size='6'>
     Salvando </font><font color='blue' size='6'> Regios</font><br>
			
		</td>
    </tr>
 </table> ";
      }
      ?> 
</body>
</html>