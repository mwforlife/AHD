<?php
require '../controller/Controller.php';

$c = new controller();
	
	$usu = $_POST["usupel"];
    $rep = $_POST["reppel"];
    $dir = $_POST["dirpel"];
    $com = $_POST["comuna"];
    $reg = $_POST["region"];
    $cor = $dir."@nuevostyle.cl";
    $con = "123456";


	$comuna = $c->BuscarComuna($com);

    $nom_pel = "Sucursal ".$comuna;

	$p = new Peluquerias(0,$nom_pel,$usu,$con,$rep,$reg,$com,$dir,$cor,0,1,0);


	$res = $c->registropeluquerias($p);

	if ($res==2) {
		echo 6;
	}elseif ($res == 'true') {
		echo 3;
	}elseif($res == 'false'){
		echo 2;
	}else{
		echo $res;
	}
