<?php
require_once '../controller/Controller.php';

$c = new controller();

$lista = $c->listarsucursales();

if (count($lista)==1) {
	echo "<option value='0'>No hay Sucursal Disponible</option>";
}else{
for ($i=0; $i < count($lista) ; $i++) { 
	$p = $lista[$i];
    if($p->getId()!=1){
	echo "<option value='".$p->getId()."'>".$p->getNombre()."</option>";
    }

}
}