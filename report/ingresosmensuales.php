<?php
include('Plantillas/Plantilla_Landscape.php');
include('../controller/Controller.php');

$c = new Controller();
$lista = $c->ingresosmensuales();

//Titulo del documento
$pdf = new PDF('L','mm',array(90,180));
$pdf->AddPage('L','A4',0);
$pdf->AliasNbPages();

$fecha = date('m-d-Y h:i:s a', time());
$pdf->SetFont('Arial','I',10);
$pdf->Cell(200);
$pdf->Cell(30,5,"Fecha Generada: $fecha",0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(90);
$pdf->Cell(95,12,'Cantidad de reservas por fecha','B',1,'R',0);
$pdf->Ln(3);

//Encabezado de la tabla
$pdf->SetFillColor(232,232,230);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50);
$pdf->Cell(80,12,'Mes',1,0,'C',1);
$pdf->Cell(80,12,'Cantidad',1,1,'C',1);

if ($lista==null) {
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(1);
    $pdf->Cell(210,12,'No hay Registros en la base de datos',1,0,'C',1);
}else{
    //Cuerpo de la tabla
    for ($i=0; $i < count($lista); $i++) { 
        $res = $lista[$i];
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50);
        $pdf->Cell(80,12,$res->getNombre(),1,0,'C',1);
        $pdf->Cell(80,12,$res->getId(),1,1,'C',1);
    }
}

$pdf->Output('I','reporte.pdf');


?>