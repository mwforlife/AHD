<?php
require '../controller/Controller.php';
$login = $_POST['nom_usu'];
$password =sha1($_POST['con_usu']);

$c = new controller();
$resultado = $c->Login_Peluqueria($login,$password);

if ($resultado ==1 ) {
	echo "Exito";
}else{
	echo "Error";
}

