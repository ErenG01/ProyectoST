<?php
session_start();
require('fpdf.php');


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
    $this->Cell(70,10,'FACTURA',0,0,'C');


    // Salto de línea
    $this->Ln(50);

    $this->Cell(30,10,'Resportes venta',0,1,'C');   


    $this->Cell(30,10, 'id_prod', 1, 0, 'c', 0);
    $this->Cell(40,10, 'nombre producto', 1, 0, 'c', 0);
    $this->Cell(45,10, 'cantidad', 1, 0, 'c', 0);
    $this->Cell(25,10, 'usuario', 1, 0, 'c', 0);
    $this->Cell(35,10, 'precio', 1, 1, 'c', 0);


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
$consulta = "SELECT * FROM  detalle_temp
where detalle_temp.usuario_id = 12";
$resultado= $mysqli-> query($consulta);





$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$textypos = 5;




$final=0;

while ($row = $resultado->fetch_assoc()) 
{
    $precio=$row['precio_venta'];
    $canti=$row['cantidad'];

    $new_v=$precio * $canti;
	$pdf->Cell(30,10, $row['id_prod'], 1, 0, 'c', 0);
	$pdf->Cell(40,10, $row['nomb_prod'], 1, 0, 'c', 0);
	$pdf->Cell(45,10, $row['cantidad'], 1, 0, 'c', 0);
	$pdf->Cell(25,10, $row['usuario_id'], 1, 0, 'c', 0);
    $pdf->Cell(35,10, $new_v, 1, 1, 'c', 0);
    $final=$final + $new_v;



}


$pdf->Cell(35,10, "Precio total: ".$final, 1, 1, 'c', 0);
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"Servitec");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Servitec LTDA");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"cr 21 este #84-30");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"7798602");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"ventas@servitec.com");

// Agregamos los datos del cliente


// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA #1");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha: 11/DIC/2019");
$pdf->setY(40);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Vencimiento: 11/ENE/2020");
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");





$pdf->Output();










?>