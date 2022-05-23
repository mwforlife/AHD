<?php
require '../controller/Controller.php';

$cod = $_POST['cod'];

$c = new controller();

$lista = $c->ListarComunas($cod);

for ($i=0; $i <count($lista) ; $i++) { 
	$co = $lista[$i];
	echo "<option value='".$co->getId()."'>".$co->getNombre()."</option>";
}
?>

