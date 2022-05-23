<?php
require_once '../controller/Controller.php';

$id = $_POST['id'];
$fecha = $_POST['fecha'];

$fecha = str_replace('/','-',$fecha);

$c = new controller();

$lista1 = $c->listarreserva3($id,$fecha);
$lista2 = $c->listarhoras();
$esta = false;

for ($i=0; $i <count($lista2) ; $i++) { 
	$s = $lista2[$i];
	for ($y=0; $y <count($lista1) ; $y++) { 
		$r = $lista1[$y];
		if ($r->getHora()==$s->getId()) {
			$esta = true;
			break;
		}
	
	}
	if ($esta==true) {
		echo "<div class='form-check form-check-inline'>";
		echo "<input class='form-check-input btn-check' disabled type='radio' name='time' id='time".$s->getId()."' value='".$s->getId()."'>";
		echo "<label class='form-check-label btn btn-outline-secondary' disabled for='time".$s->getId()."'>".$s->getNombre()."</label>";
		echo "</div>";
	}else{
		echo "<div class='form-check form-check-inline'>";
		echo "<input class='form-check-input btn-check'  type='radio' name='time' id='time".$s->getId()."' value='".$s->getId()."'>";
		echo "<label class='form-check-label btn btn-outline-danger'  for='time".$s->getId()."'>".$s->getNombre()."</label>";
		echo "</div>";
	}

	$esta=false;

}


