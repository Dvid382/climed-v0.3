<?php

require_once('TCPDF/tcpdf.php');
require_once '../controlador/LaboratoriosController.php';
$controlador = new LaboratoriosController();
$laboratorios = $controlador->verTodos();

$pdf = new TCPDF('LANDSCAPE', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

// Establecer los metadatos del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CLIMED');
$pdf->SetTitle('Reporte de Laboratorios');
$pdf->SetSubject('Reporte');
$pdf->SetKeywords('TCPDF, PDF, Reporte, Laboratorios');

// Agregar la primera página
$pdf->AddPage();

// Agregar el encabezado del reporte
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 15, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'INSTITUTO AUTONOMO DE LA SALUD DEL ESTADO YARACUY', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'ALCALDIA DEL MUNICIPIO INDEPENDENCIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(5);
$pdf->Cell(0, 15, 'CONSULTORIO MEDICO POPULAR "HUMBERTO SILVA"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
$pdf->Ln(15);

// Agregar los datos de los Laboratorios
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(60, 10, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Estatus', 1, 0, 'C', 0);
$pdf->Cell(60, 10, 'Valor', 1, 0, 'C', 0);
$pdf->Cell(80, 10, 'Descripción', 1, 1, 'C', 0);

foreach ($laboratorios as $laboratorio) {
    $pdf->Cell(60, 10, $laboratorio['nombre'], 1, 0, 'L', 0);
    $pdf->Cell(20, 10, ($laboratorio['estatus'] == 1) ? 'Activo' : 'Inactivo', 1, 0, 'C', 0);
    $pdf->Cell(60, 10, ($laboratorio['valor'] == 1) ? 'Análisis de sangre	' : (($laboratorio['valor'] == 2) ? 'Análisis de orina' : (($laboratorio['valor'] == 3) ? 'Análisis de heces' : (($laboratorio['valor'] == 4) ? 'Examen de microbiología' : 'Pruebas de diagnóstico molecular'))), 1, 0, 'C', 0);
    $pdf->MultiCell(80, 10, $laboratorio['descripcion'], 1, 'L', 0, 1);
    /*$pdf->SetX($pdf->GetX() - 180);*/
}

// Generar el PDF
$pdf->Output('reporte_Laboratorios.pdf', 'I');
