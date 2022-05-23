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
$pdf->Cell(90);
$pdf->Cell(95,12,'Cantidad de reservas por fecha','B',1,'R',0);
$pdf->Ln(3);

//Encabezado de la tabla
$pdf->SetFillColor(232,232,230);
$pdf->SetFont('Times','B',14);
$pdf->Cell(50);
$pdf->Cell(80,12,'Fecha',1,0,'C',1);
$pdf->Cell(80,12,'Cantidad',1,1,'C',1);



$lista = $c->listarsucursales();

    //Creando las variables
    $cadena = array();
    $valores = array();

    for ($i=0; $i < count($lista); $i++) { 
        //Sacar peluqueria dentro del array para buscar su valor
    $p = $lista[$i];
    if($p->getId()!=1){
        //Buscar cantidad de reservas
        $lista = $c->estadisticas3($p->getId());    
    }else{
        $lista = $c->estadisticas4();
    }
    //Extraendo datos dentro de la lista
    //Creando los Subarray
    for ($i=0; $i < count($lista); $i++) { 
        $s = $lista[$i];
        $cadena[] = $s->getNombre();
        $valores[] = $s->getId();
    }

    //Cuerpo de la tabla
    for ($i=0; $i < count($lista); $i++) { 
        $res = $lista[$i];
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(50);
        $pdf->Cell(80,12,$res->getNombre(),1,0,'C',1);
        $pdf->Cell(80,12,$res->getId(),1,1,'C',1);
    }


$pdf->Output('I','reporte.pdf');






    }?>