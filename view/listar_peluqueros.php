<?php
require_once '../controller/Controller.php';

$c = new controller();

$id = $_POST['id_pel'];

$lista = $c->listarpeluqueros($id);

if (count($lista)==0) {
	echo "<option value='0'>No Hay Trabajadores Disponible</option>";
}else{
    $_SESSION['sucursal'] = $lista;
for ($i=0; $i < count($lista) ; $i++) { 
	$p = $lista[$i];
    if($p->getTipo()!="Recepcionista" && $p->getTipo()!="Auxiliar de Aseo"){
	echo "<option value='".$p->getId()."' style='background-image:url(../img/logo/logo.png)".$p->getFoto()."' >".$p->getNombre()." - ".$p->getTipo()."</option>";
    }

}
}
