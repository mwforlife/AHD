<?php
session_start();
require_once '../controller/Controller.php';

$c = new controller();
	
    $id = $_POST["txt_ind"];
	$nom = $_POST["nomtra"];
	$ape = $_POST["apetra"];
    $usu = substr($ape,0,1) . $nom;
    $pas = "123456";
    $eda = str_replace("/","-",$_POST["edatra"]);
    $dir = $_POST["dirtra"];
    $cor = $_POST["cortra"];
    $tel = $_POST["teltra"];
    $com = $_POST["comuna"];
    $reg = $_POST["region"];
    
  
    $pel= $_SESSION['user_pel'];
    $car = $_POST["cargo"];
    if(isset($_POST["peluqueria"])){
        $pel = $_POST["peluqueria"];
    }
    $sue = $_POST["suetra"];
    $ini_con = $_POST['ini-con'];
    $term_con = $_POST['term-con'];
    
    //Recuperando datos de la imagen
    $nombre_imagen = "imagen_".date("dHis").".".pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    //$tipo_imagen = $_FILES['foto']['type'];
    //$tamanio_imagen = $_FILES['foto']['size'];

    //Ruta de destino para guardar imagen en el servidor
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/AHD/img/image_server/workers_profile/';

    //Guardar la imagen en la carpeta de destino
    move_uploaded_file($_FILES['foto']['tmp_name'],$carpeta_destino.$nombre_imagen);


	$t = new Trabajadores($id, $nom, $ape, $eda, $reg, $com, $dir, $car,$nombre_imagen,0,0);
    
    $dt = new Detalles_trabajadores(0,$pel,$id,$usu,$pas,$sue,$cor,$tel,$ini_con,$term_con);

	$res = $c->registrartrabajadores($t,$dt);

	if ($res==1) {
		echo "Trabajador registrado con exito";
	}elseif ($res == 'true') {
		echo "El Trabajador ya estaba registrado en el sistema y ha sido asociado con exito al Sucursal";
	}elseif($res == 'false'){
		echo "Error de registro, comprueba los datos";
	}else{
		echo $res;
	}


