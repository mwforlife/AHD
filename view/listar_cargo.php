<?php
require_once '../controller/Controller.php';

$c = new controller();

$lista = $c->listarcargos();

if (count($lista)==0) {
	echo "<option value='0'>No Hay Cargo Disponible</option>";
}else{
for ($i=0; $i < count($lista) ; $i++) { 
	$p = $lista[$i];
	echo "<option value='".$p->getId()."'>".$p->getTipo()."</option>";
    
}
}