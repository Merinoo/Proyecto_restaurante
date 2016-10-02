<?php
require('../pdf/fpdf.php');
require('../conexion.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(4, 10, '', 0);
$pdf->Image('../logo/logo.png' , 10 ,9.5, 12 , 12,'png');
$pdf->Cell(10,8,'',0);
$pdf->Cell(150, 10, 'Merino Entreprise S.L.', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(18);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'USUARIOS DE BAR MERI', 0);
$pdf->Ln(13);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 8, 'USUARIO', 1,0,"C");
$pdf->Cell(60, 8, 'FECHA PEDIDO', 1,0,"C");
$pdf->Cell(60, 8, 'IMPORTE TOTAL', 1,0,"C");
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$consulta="SELECT * FROM pedidos,usuarios WHERE pedidos.Usuario_idusuario=usuarios.idusuario";
$result = $connection->query($consulta);
$totalli = 0;
$total = 0;
while($fila = $result->fetch_object()){
	$pdf->Cell(60, 8,$fila->Username, 1,0,"C");
	$pdf->Cell(60, 8,$fila->Fecha_pedido, 1,0,"C");
	$pdf->Cell(60, 8,$fila->Coste_total." E",1,0,"C");
	$pdf->Ln(8);
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Output();
?>
