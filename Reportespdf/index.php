<?php
require('fpdf.php');

class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    // Logo
    $this->Image('../logo/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','b',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Sistema ventas de equipos de computacion',0,0,'C');

    // Salto de línea
    $this->Ln(20);

    $this->Cell(70,10,'Resportes usuarios',0,1,'C');	

    $this->Cell(55,10, 'nombre', 1, 0, 'c', 0);
    $this->Cell(75,10, 'correo', 1, 0, 'c', 0);
    $this->Cell(35,10, 'usuario', 1, 0, 'c', 0);
    $this->Cell(20,10, 'rol', 1, 1, 'c', 0);	

}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cb.php';
$consulta = "SELECT * FROM registro_sesion";
$resultado= $mysqli-> query($consulta);


$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while ($row = $resultado->fetch_assoc()) 
{
	$pdf->Cell(55,10, $row['nombre'], 1, 0, 'c', 0);
	$pdf->Cell(75,10, $row['correo'], 1, 0, 'c', 0);
	$pdf->Cell(35,10, $row['usuario'], 1, 0, 'c', 0);
	$pdf->Cell(20,10, $row['rol'], 1, 1, 'c', 0);
}

$pdf->Output();
?>