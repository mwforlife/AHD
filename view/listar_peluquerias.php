<?php
require '../controller/Controller.php';
session_start();
$c = new controller();

$lista = $c->listarsucursales();

if (count($lista)<2) {
	echo "<option value='0'>No Hay Sucursal Disponible</option>";
}else{
for ($i=0; $i < count($lista) ; $i++) { 
	$p = $lista[$i];
    if (isset($_SESSION['user_pel'])) {
        if ($_SESSION['user_pel']==1) {
            if($p->getId()!=1){
                echo "<div class='card'>";
                echo " <div class='card-header' id='headingOne'>";
                echo "<h5 class='mb-0'>";
                echo "<button class='btn btn-link' data-bs-toggle='collapse' data-bs-target='#collapse".$p->getId()."' aria-expanded='true' aria-controls='collapseOne'>
                ".$p->getNombre()." </button>";
                echo "</h5>";
                echo "</div>";
                echo "<div id='collapse".$p->getId()."' class='collapse' aria-labelledby='headingOne' data-parent='#accordion'> <div class='card-body'>";
                echo "Representante: ".$p->getRepresentante()."<br>";
                echo "Region            : ".$p->getId_reg()."<br>";
                echo "Comuna            : ".$p->getId_com()."<br>";
                echo "Direccion         : ".$p->getDireccion()."<br>";
                echo "Correo Electronico: ".$p->getCorreo()."<br>";
                
                if (isset($_SESSION['user_pel'])) {
                    if ($p->getEstado()==1 and $_SESSION['user_pel']==1) {
                        echo "Estado            : Habilitada<br>";
                        }else{
                        echo "Estado            : Deshabilitada<br>";
                        }
                   if ($_SESSION['user_pel']==1) {
                    echo "<button class='btn btn-success' title='Habilitar Sucursal' onclick='Habilidarsucursal(".$p->getId().")' data-bs-toggle='modal' data-bs-target='#mod-pel' onclick='mostrardatos(".$p->getId().")'><img src='../img/iconos/pen.png' height='30' width='30'></button>";
                    echo "<button class='btn btn-danger' title='Deshabilitar Sucursal' onclick='eliminarsucursal(".$p->getId().")'><img src='../img/iconos/delete.png' height='30' width='30'></button>";
                   }
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
                }



        }else{
            if($p->getId()!=1 and $p->getEstado()==1){
                echo "<div class='card1'>";
                echo " <div class='card-header' id='headingOne'>";
                echo "<h5 class='mb-0'>";
                echo "<button class='btn btn-link' data-bs-toggle='collapse' data-bs-target='#collapse".$p->getId()."' aria-expanded='true' aria-controls='collapseOne'>
                ".$p->getNombre()."</button>";
                echo "</h5>";
                echo "</div>";
                echo "<div id='collapse".$p->getId()."' class='collapse' aria-labelledby='headingOne' data-parent='#accordion'> <div class='card-body'>";
                echo "Representante: ".$p->getRepresentante()."<br>";
                echo "Region            : ".$p->getId_reg()."<br>";
                echo "Comuna            : ".$p->getId_com()."<br>";
                echo "Direccion         : ".$p->getDireccion()."<br>";
                echo "Correo Electronico: ".$p->getCorreo()."<br>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                }
        }
    }else{
        if($p->getId()!=1 and $p->getEstado()==1){
            echo "<div class='card1'>";
            echo " <div class='card-header' id='headingOne'>";
            echo "<h5 class='mb-0'>";
            echo "<button class='btn btn-link' data-bs-toggle='collapse' data-bs-target='#collapse".$p->getId()."' aria-expanded='true' aria-controls='collapseOne'>
            ".$p->getNombre()."</button>";
            echo "</h5>";
            echo "</div>";
            echo "<div id='collapse".$p->getId()."' class='collapse' aria-labelledby='headingOne' data-parent='#accordion'> <div class='card-body'>";
            echo "Representante: ".$p->getRepresentante()."<br>";
            echo "Region            : ".$p->getId_reg()."<br>";
            echo "Comuna            : ".$p->getId_com()."<br>";
            echo "Direccion         : ".$p->getDireccion()."<br>";
            echo "Correo Electronico: ".$p->getCorreo()."<br>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            }
    }
    

}
}