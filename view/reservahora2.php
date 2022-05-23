<?php
session_start();
require_once '../controller/Controller.php';
$c = new controller();
$error = 0;

$usu = $_POST['ind_val'];
if ($usu=="") {
	$usu = "EL identificador no puede estar vacio";
	$error++;
}else{
	if ($c->buscarUsuario($usu)==null) {
		echo "La identificacion ingresada no esta registrada en el sistema \n por ende se dee registrar previamente al cliente antes de registrar la reserva \n Gracias";
		exit;
	}	
}



$sucur = $_SESSION['pel_tra'];

$service="Debes Seleccionar un Servicio";

if (isset($_POST['service'])) {
	$service = $_POST["service"];
}else{
	$error++;
}
$fec = $_POST['fec_res'];
if ($fec=="") {
	$fec="Debes seleccionar una fecha";
	$error++;
}
$hor = "Debes Seleccionar una hora";
if (isset($_POST['time'])) {
	$hor=$_POST['time'];
}else{
	$error++;
}

$pel = $_POST['peluquero'];

if ($error>0) {
echo "Cliente: ".$usu. "Servicio: ".$service . "\n Sucursal: ".$sucur."\n Fecha: ".$fec." \n Hora: ".$hor."\n Peluquero: ".$pel;
}else{
	$r = new Reserva(0,$sucur,1,$service,$usu,$hor,$fec,$pel);
	$res = $c->registrarreserva($r);
	if ($res==1) {
		echo 3;

	}elseif ($res=="Error") {
		"No se pudo registrar la hora, Verifique los datos";
	}else{
		echo $res;
	}


}







?>