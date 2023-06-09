<?php

// Archivo imp_recibo.php, donde se generea el recibo en pdf 

// Se incluyen la biblioteca fpdf que permite crear archivos pdf
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página

    function Header()
    {
        // Logo
        $this->Image('cabecera.jpg', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(90);
        // Título
        $this->Cell(30, 10, 'Consultorios Medical\'s Monterrey', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
        $this->Cell(90);
        // Título
        $this->Cell(30, 10, '"Salvando Regios"', 0, 0, 'C');
        // Salto de línea
        $this->Ln(15);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
// Obtener el id_recibo del parámetro GET
$id_recibo = $_GET['id_recibo'];
// Incluir el archivo de conexión
require("conexion.php");

// Consultar el recibo en la base de datos
$consulta = "SELECT * FROM v_recibo where id_recibo='" . $id_recibo . "'";
$resultado = mysqli_query($conexion, $consulta);

// Crear una instancia de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Recorrer los resultados de la consulta
while ($row = $resultado->fetch_assoc()) {
    // Agregar información al PDF

    $pdf->Cell(30, 10, utf8_decode('Dirección:'), 0, 0, 'L', 0);
    $pdf->Cell(90, 10, $row['direccion_suc'], 0, 1, 'L', 0);

    $pdf->Cell(30, 10, utf8_decode('Teléfono:'), 0, 0, 'L', 0);
    $pdf->Cell(90, 10, $row['telefono_suc'], 0, 1, 'L', 0);

    $pdf->Cell(180, 20, utf8_decode('Recibo'), 0, 0, 'C', 0);
    $pdf->Cell(10, 20, $row['id_recibo'], 0, 1, 'R', 0);

    $pdf->Cell(125, 10, 'Fecha:', 0, 0, 'R', 0);
    $pdf->Cell(40, 10, $row['fecha_generacion'], 0, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['hora_generacion'], 0, 1, 'L', 0);

    $pdf->Cell(190, 20, 'Datos Del Paciente:', 0, 1, 'L', 0);
    $pdf->Cell(150, 10, $row['paciente'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['telefono_paciente'], 1, 1, 'C', 0);

    $pdf->Cell(190, 20, 'Detalles', 0, 1, 'L', 0);
    $pdf->Cell(130, 30, 'Consulta General       .............                $', 0, 0, 'R', 0);
    $pdf->Cell(80, 30, $row['costo'], 0, 1, 'L', 0);
}

$pdf->Output();
?>