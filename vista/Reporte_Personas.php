<?php

require_once('TCPDF/tcpdf.php');
require_once '../controlador/PersonasController.php';
$controlador = new PersonasController();
$personas = $controlador->verTodosPersonas();

$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// Establecer los metadatos del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CLIMED');
$pdf->SetTitle('Reporte de Personas');
$pdf->SetSubject('Reporte');
$pdf->SetKeywords('TCPDF, PDF, Reporte, Personas');

// Agregar la primera página
$pdf->AddPage();

// Agregar el encabezado del reporte
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Ln(5);
$pdf->Cell(0, 15, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'INSTITUTO AUTONOMO DE LA SALUD DEL ESTADO YARACUY', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'ALCALDIA DEL MUNICIPIO INDEPENDENCIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'CONSULTORIO MEDICO POPULAR "HUMBERTO SILVA"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);

// Agregar los datos de las personas
$pdf->SetFont('helvetica', '', 6);
$pdf->Cell(20, 10, 'Cédula', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Primer Nombre', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Primer Apellido', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Teléfono', 1, 0, 'C', 0);
$pdf->Cell(40, 10, 'Correo', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Sexo', 1, 0, 'C', 0);
$pdf->Cell(60, 10, 'Dirección', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'F. Nacimiento', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Edad', 1, 1, 'C', 0);

foreach ($personas as $persona) {
    $f_nacimiento = $persona['f_nacimiento'];
    $fecha_actual = date('Y-m-d');

    $diferencia_en_segundos = strtotime($fecha_actual) - strtotime($f_nacimiento);
    $segundos_en_un_año = 365.25 * 24 * 60 * 60;
    $edad_en_años = floor($diferencia_en_segundos / $segundos_en_un_año);

    $pdf->Cell(20, 10, $persona['cedula'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $persona['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $persona['apellido'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $persona['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $persona['correo'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, ($persona['sexo'] == 1) ? 'Masculino' : 'Femenino', 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $persona['direccion'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $persona['f_nacimiento'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $edad_en_años, 1, 1, 'C', 0); // Salto de página al final de cada fila
}

// Generar el PDF
$pdf->Output('reporte_personas.pdf', 'I');
?>
