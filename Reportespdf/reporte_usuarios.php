<?php
require('fpdf.php');

if (isset($_POST['btn_report'])) 
{
    $fecha1=$_POST['fech1'];
    $fecha2=$_POST['fech2'];

    
}

class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    // Logo
    $this->Image('../logo/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','b',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Sistema ventas de equipos de computacion',0,0,'C');

    // Salto de línea
    $this->Ln(20);

    $this->Cell(30,10,'Resportes usuarios',0,1,'C');	

    $this->Cell(30,10,'Id_usuario',1,0,'C');
    $this->Cell(30,10, 'nombre', 1, 0, 'c', 0);
    $this->Cell(45,10, 'correo', 1, 0, 'c', 0);
    $this->Cell(25,10, 'usuario', 1, 0, 'c', 0);
    $this->Cell(25,10, 'rol', 1, 0, 'c', 0);
    $this->Cell(35,10, 'estatus', 1, 1, 'c', 0);	

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
$consulta = "SELECT * FROM registro_sesion
WHERE fecha_add BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:59'";
$resultado= $mysqli-> query($consulta);


$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while ($row = $resultado->fetch_assoc()) 
{
	$pdf->Cell(30,10, $row['Id_usuario'], 1, 0, 'c', 0);
	$pdf->Cell(30,10, $row['nombre'], 1, 0, 'c', 0);
	$pdf->Cell(45,10, $row['correo'], 1, 0, 'c', 0);
	$pdf->Cell(25,10, $row['usuario'], 1, 0, 'c', 0);
    $pdf->Cell(25,10, $row['estatus'], 1, 0, 'c', 0);
    $pdf->Cell(35,10, $row['rol'], 1, 1, 'c', 0);
    
}

$pdf->Output();
?>