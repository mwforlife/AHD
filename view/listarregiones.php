<?php
require '../controller/Controller.php';

$c = new controller();

$lista = $c->ListarRegiones();

for ($i=0; $i <count($lista) ; $i++) { 
	$r = $lista[$i];
	echo "<option value='".$r->getId()."'>".$r->getNombre()."</option>";
}
?>
