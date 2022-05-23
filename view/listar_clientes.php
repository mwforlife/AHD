<?php
require '../controller/Controller.php';

$c = new controller();

$lista = $c->ListarClientes();

if (is_null($lista)) {
	echo "<tr><td>No hay clientes Registrados</td></tr>";	
}else{
for ($i=0; $i <count($lista) ; $i++) { 
	$u = $lista[$i];
echo "<tr>";
	echo "<td>".$u->getId_usuario()."</td>";
	echo "<td>".$u->getNombre()."</td>";
	echo "<td>".$u->getApellido()."</td>";
	echo "<td>".$u->getFec_nac()."</td>";
	echo "<td>".$u->getSexo()."</td>";
	echo "<td>".$u->getTelefono()."</td>";
	echo "<td>".$u->getCorreo()."</td>";
echo "</tr>";
}
}