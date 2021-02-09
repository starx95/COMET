<?php
require('libs/fpdf.php');

$pdf = new FPDF();

$pdf->AddPage();

$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 20;  //define cell width
$cell_height=7;    //define cell height

$pdf->SetFont('Arial','',16);

$pdf->MultiCell($cell_width,$cell_height,'Hi1',1); //print one cell value
$current_x+=$cell_width;                           //calculate position for next cell
$pdf->SetXY($current_x, $current_y);               //set position for next cell to print

$pdf->MultiCell($cell_width,$cell_height,'Hi2',1); //printing next cell
$current_x+=$cell_width;                           //re-calculate position for next cell
$pdf->SetXY($current_x, $current_y);               //set position for next cell

$pdf->MultiCell($cell_width,$cell_height,'Hi3',1);
$current_x+=$cell_width;

$pdf->Ln();
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line

$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width,$cell_height,'Hi4',1);
$current_x+=$cell_width;
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width,$cell_height,'Hi5(xtra)',1);
$current_x+=$cell_width;
$pdf->SetXY($current_x, $current_y);

$pdf->MultiCell($cell_width,$cell_height,'Hi5',1);
$current_x+=$cell_width;
$pdf->SetXY($current_x, $current_y);

$pdf->Output();
?>