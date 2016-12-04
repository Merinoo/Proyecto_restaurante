<?php
require('./pdf/fpdf.php');
require('conexion.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(4, 10, '', 0);
$pdf->Image('./logo/logo.png' , 10 ,9.5, 12 , 12,'png');
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
$pdf->Cell(45, 8, 'USUARIO', 1,0,"C");
$pdf->Cell(45, 8, 'NOMBRE', 1,0,"C");
$pdf->Cell(45, 8, 'CANTIDAD', 1,0,"C");
$pdf->Cell(45, 8, 'PRECIO', 1,0,"C");
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$Npedido=$_GET["NPedido"];
$consulta = "SELECT usuarios.Username,producto.Nombre,detalle_pedido.Cantidad,producto.Precio FROM usuarios,pedidos,detalle_pedido,producto WHERE usuarios.idusuario=pedidos.Usuario_idusuario and pedidos.Num_pedido=detalle_pedido.Pedidos_Num_pedido and producto.IdProducto = detalle_pedido.Producto_IdProducto AND Pedidos_Num_pedido = $Npedido;";
$result = $connection->query($consulta);
$totalli = 0;
$total = 0;
while($fila = $result->fetch_object()){
	$pdf->Cell(45, 8,$fila->Username, 1,0,"C");
	$pdf->Cell(45, 8,$fila->Nombre,1,0,"C");
  $pdf->Cell(45, 8,$fila->Cantidad,1,0,"C");
  $pdf->Cell(45, 8,($fila->Precio*$fila->Cantidad)." E",1,0,"C");
	$pdf->Ln(8);
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Output();
?>
