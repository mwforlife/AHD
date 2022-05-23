<?php
require_once '../controller/Controller.php';

$c = new controller();

$lista = $c->listarservicios();

if (is_null($lista)) {
	echo "<div><h4>No hay servicios Registrado</h4></div>";
}else{
	for ($i=0; $i < count($lista) ; $i++) { 
		$s = $lista[$i];
        echo "<div class='form-check form-check-inline'>";
     echo "<input class='form-check-input btn-check' type='radio' name='service' id='service".$s->getId()."' value='".$s->getId()."'>";
     echo "<label class='form-check-label btn btn-outline-success' for='service".$s->getId()."'>".$s->getNombre()."</label>";
     echo "</div>"; 
	}
    
        
}