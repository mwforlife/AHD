<?php
include('Plantillas/Plantilla_Landscape.php');
include('../controller/Controller.php');

session_start();
$c = new Controller();
$id = $_SESSION['user_pel'];
$lista = $c->ListarClientes();

$pdf = new PDF('L','mm',array(90,180));
$pdf->AddPage('L','A4',0);
$pdf->AliasNbPages();

$fecha = date('m-d-Y h:i:s a', time());
$pdf->SetFont('Arial','I',10);
$pdf->Cell(200);
$pdf->Cell(30,5,"Fecha Generada: $fecha",0,1,'C');

$pdf->SetFont('Arial','B',18);
$pdf->Cell(100);
$pdf->Cell(60,12,'Listado de Usuarios','B',1,'R',0);

//Encabezado de la tabla
$pdf->SetFillColor(232,232,230);
$pdf->SetFont('Times','B',12);
$pdf->Cell(40,12,'Identificador',1,0,'C',1);
$pdf->Cell(40,12,'Nombre',1,0,'C',1);
$pdf->Cell(40,12,'Apellido',1,0,'C',1);
$pdf->Cell(40,12,'Fecha de Nacimiento',1,0,'C',1);
$pdf->Cell(40,12,'Sexo',1,0,'C',1);
$pdf->Cell(40,12,'Telefono',1,0,'C',1);
$pdf->Cell(40,12,'Correo',1,1,'C',1);

if ($lista==null) {
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(1);
    $pdf->Cell(280,12,'No hay Registros en la base de datos',1,0,'C',1);
}else{
//Cuerpo de la tabla
for ($i=0; $i < count($lista); $i++) { 
    $u = $lista[$i];
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,12,$u->getId_usuario(),1,0,'L',1);
    $pdf->Cell(40,12,$u->getNombre(),1,0,'L',1);
    $pdf->Cell(40,12,$u->getApellido(),1,0,'L',1);
    $pdf->Cell(40,12,$u->getFec_nac(),1,0,'L',1);
    $pdf->Cell(40,12,$u->getSexo(),1,0,'L',1);
    $pdf->Cell(40,12,$u->getTelefono(),1,0,'R',1);
    $pdf->Cell(40,12,$u->getCorreo(),1,1,'R',1);
}
}


$pdf->Output();

?>