<?php
include('Plantillas/Plantilla_Landscape.php');
include('../controller/Controller.php');


$dateini = $_POST['dateini'];
$dateterm = $_POST['dateterm'];

$dateini = str_replace("/","-",$dateini);
$dateterm = str_replace("/","-",$dateterm);

session_start();
$c = new Controller();
$id = $_SESSION['user_pel'];
$lista = $c->listartrabajadores1($id,$dateini,$dateterm);

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
$pdf->Cell(75,12,'Listado de Trabajadores','B',1,'R',0);

//Encabezado de la tabla
$pdf->SetFillColor(232,232,230);
$pdf->SetFont('Times','B',14);
$pdf->Cell(7);
$pdf->Cell(40,12,'Identificador',1,0,'C',1);
$pdf->Cell(60,12,'Nombre',1,0,'C',1);
$pdf->Cell(40,12,'Cargo',1,0,'C',1);
$pdf->Cell(40,12,'Inicio Contrato',1,0,'C',1);
$pdf->Cell(40,12,'Termino Contrato',1,0,'C',1);
$pdf->Cell(40,12,'Salario',1,0,'C',1);


$pdf->SetFont('Arial','B',18);
$pdf->Cell(95);
$pdf->Cell(75,12,count($lista),'B',1,'R',0);

if ($lista==null) {
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(1);
    $pdf->Cell(260,12,'No hay Registros en la base de datos',1,0,'C',1);
}else{
//Cuerpo de la tabla
for ($i=0; $i < count($lista); $i++) { 
    $t = $lista[$i];
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(7);
    $pdf->Cell(40,12,$t->getId(),1,0,'L',1);
    $pdf->Cell(60,12,$t->getNombre()." ".$t->getApellido(),1,0,'L',1);
    $pdf->Cell(40,12,$t->getTipo(),1,0,'L',1);
    $pdf->Cell(40,12,$t->getFecnac(),1,0,'L',1);
    $pdf->Cell(40,12,$t->getDireccion(),1,0,'L',1);
    $pdf->Cell(40,12,"$".$t->getCreated(),1,1,'R',1);
}
}

$pdf->Output('I','reporte.pdf');
?>


?>