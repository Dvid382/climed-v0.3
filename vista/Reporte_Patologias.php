<?php

require_once('TCPDF/tcpdf.php');
require_once '../controlador/PatologiasController.php';
$controlador = new PatologiasController();
$patologias = $controlador->verTodos();

$pdf = new TCPDF('LANDSCAPE', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

// Establecer los metadatos del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CLIMED');
$pdf->SetTitle('Reporte de Patologias');
$pdf->SetSubject('Reporte');
$pdf->SetKeywords('TCPDF, PDF, Reporte, Patologias');

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

// Agregar los datos de los Patologias
$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(60, 10, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'Estatus', 1, 0, 'C', 0);
$pdf->Cell(60, 10, 'Valor', 1, 0, 'C', 0);
$pdf->Cell(80, 10, 'Descripción', 1, 1, 'C', 0);

foreach ($patologias as $patologia) {
    $pdf->Cell(60, 10, $patologia['nombre'], 1, 0, 'L', 0);
    $pdf->Cell(20, 10, ($patologia['estatus'] == 1) ? 'Activo' : 'Inactivo', 1, 0, 'C', 0);
    $pdf->Cell(60, 10, ($patologia['valor'] == 1) ? 'Enfermedades infecciosas' : (($patologia['valor'] == 2) ? 'Enfermedades no infecciosas' : (($patologia['valor'] == 3) ? 'Traumatismos' : (($patologia['valor'] == 4) ? 'Enfermedades congénitas' : 'Trastornos mentales'))), 1, 0, 'C', 0);
    $pdf->MultiCell(80, 10, $patologia['descripcion'], 1, 'L', 0, 1);
    /*$pdf->SetX($pdf->GetX() - 180);*/
}

// Generar el PDF
$pdf->Output('reporte_Patologias.pdf', 'I');
