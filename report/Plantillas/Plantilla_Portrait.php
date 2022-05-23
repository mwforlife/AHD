<?php
include 'fpdf/fpdf.php';

class PDF extends FPDF{
    function Header(){
        $this->AddLink();
        $this->Image('image/logo.png',10,10,55,0,'','www.wilkenstech.host');
        $this->SetFont('Arial','B',18);
        $this->Cell(80);
        $this->Cell(30,10,'AHD Hairdresser Manager',0,1,'C');
        $this->SetFont('Arial',14);
        $this->Cell(80);
        $this->Cell(30,10,'Nuevo Style',0,1,'C');
        $this->Ln(10);
    }


    function Footer(){
        $this->SetY(-18);
        $this->SetFont('Arial','I',12);
        $this->AddLink();
        $this->Cell(5,10,'www.wilkenstech.host',0,0,'L');
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,utf8_decode('Página').$this->PageNo().' de {nb}',0,0,'C');
    }
}

?>