<?php
include('Plantillas/Plantilla_Landscape.php');
include('../controller/Controller.php');

session_start();
$c = new Controller();
$id = $_SESSION['user_pel'];
$lista = $c->listarreserva5();

//Titulo del documento
$pdf = new PDF('L','mm',array(90,180));
$pdf->AddPage('L','A4',0);
$pdf->AliasNbPages();

$fecha = date('m-d-Y h:i:s a', time());
$pdf->SetFont('Arial','I',10);
$pdf->Cell(200);
$pdf->Cell(30,5,"Fecha Generada: $fecha",0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(95);
$pdf->Cell(75,12,'Listado de Reservas','B',1,'R',0);

//Encabezado de la tabla
$pdf->SetFillColor(232,232,230);
$pdf->SetFont('Times','B',14);
$pdf->Cell(1);
$pdf->Cell(40,12,'Identificador',1,0,'C',1);
$pdf->Cell(50,12,'Nombre',1,0,'C',1);
$pdf->Cell(40,12,'Servicio',1,0,'C',1);
$pdf->Cell(30,12,'Fecha',1,0,'C',1);
$pdf->Cell(30,12,'Hora',1,0,'C',1);
$pdf->Cell(30,12,'Estado',1,0,'C',1);
$pdf->Cell(55,12,'Sucursal',1,0,'C',1);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(95);
$pdf->Cell(75,12,count($lista),'B',1,'R',0);

//Cuerpo de la tabla
for ($i=0; $i < count($lista); $i++) { 
    $res = $lista[$i];
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(1);
    $pdf->Cell(40,12,$res->getId_usuario(),1,0,'L',1);
    $pdf->Cell(50,12,$res->getId_peluqueria(),1,0,'L',1);
    $pdf->Cell(40,12,$res->getId_servicio(),1,0,'L',1);
    $pdf->Cell(30,12,$res->getFecha(),1,0,'L',1);
    $pdf->Cell(30,12,$res->getHora(),1,0,'L',1);
    $pdf->Cell(30,12,$res->getId_estado(),1,0,'L',1);
    $pdf->Cell(55,12,$res->getTrabajador(),1,1,'L',1);
}


$pdf->Output('I','reporte.pdf');
?>