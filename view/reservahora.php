<?php
session_start();

$nombre = $_SESSION['nombre_completo'];
$correo = $_SESSION['cor_usu'];

require_once '../controller/Controller.php';

$c = new controller();
$usu = $_SESSION['id_usu'];
$error = 0;

$service="Debes Seleccionar un Servicio";

if (isset($_POST['service'])) {
	$service = $_POST["service"];
}else{
	$error++;
}
$sucur = $_POST['txtsucur'];
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
echo "Servicio: ".$service . "\n Sucursal: ".$sucur."\n Fecha: ".$fec." \n Hora: ".$hor."\n Peluquero: ".$pel;
}else{
	$r = new Reserva(0,$sucur,1,$service,$usu,$hor,$fec,$pel);
	$res = $c->registrarreserva($r);
	if ($res==1) {
		echo 3;

		$lista = $c->listarservicios();
		$ser = "Undifined";
		if (is_null($lista)) {
			echo "<div><h4>No hay servicios Registrado</h4></div>";
		}else{
			for ($i=0; $i < count($lista) ; $i++) { 
				$s = $lista[$i];
				if ($s->getId()==$service) {
					$ser = $s->getNombre();
				}
			}
		}

		$lista = $c->listarhoras();
		if (is_null($lista)) {
			echo "<div><h4>No hay Horas Registrado</h4></div>";
		}else{
			for ($i=0; $i < count($lista) ; $i++) { 
				$s = $lista[$i];
				if ($s->getId()==$hor) {
					$hor = $s->getNombre();
				}
			}
		}


		// allow for demo mode testing of emails
		define("DEMO", false); // setting to TRUE will stop the email from sending.

		// set the location of the template file to be loaded
		$template_file = "../templates/reserve_template.php";
	
		// set the email 'from' information
		$email_from = "AHD - Reserva Hora <ahd@wilkenstech.host>";
	
		// create a list of the variables to be swapped in the html template
		$swap_var = array(
			"{SITE_ADDR}" => "https://www.wilkenstech.host",
			"{EMAIL_LOGO}" => "https://wilkenstech.host/AHD2.0/img/logo/logo.png",
			"{EMAIL_TITLE}" => "Su reserva ha sido Generada con exito",
			"{CUSTOM_IMG}" => "",
			"{RESERVE_DATE}"=> $fec,
			"{RESERVE_HOUR}"=>$hor,
			"{RESERVE_SERVICE}"=>$ser,
			"{TO_NAME}" => $nombre,
			"{TO_EMAIL}" => $correo
		);
	
		// create the email headers to being the email
		$email_headers = "From: ".$email_from."\r\nReply-To: ".$email_from."\r\n";
		$email_headers .= "MIME-Version: 1.0\r\n";
		$email_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
		// load the email to and subject from the $swap_var
		$email_to = $swap_var['{TO_EMAIL}'];
		$email_subject = $swap_var['{EMAIL_TITLE}']; // you can add time() to get unique subjects for testing: time();
	
		// load in the template file for processing (after we make sure it exists)
		if (file_exists($template_file))
			$email_message = file_get_contents($template_file);
		else
			die ("Unable to locate your template file");
	
		// search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
		foreach (array_keys($swap_var) as $key){
			if (strlen($key) > 2 && trim($swap_var[$key]) != '')
				$email_message = str_replace($key, $swap_var[$key], $email_message);
		}
	
		// check if the email script is in demo mode, if it is then dont actually send an email
		if (DEMO)
			die("<hr /><center>This is a demo of the HTML email to be sent. No email was sent. </center>");
	
		// send the email out to the user  
		if ($_SESSION['reporte']==1) { 
	   	mail($email_to, $email_subject, $email_message, $email_headers);
		}

	}elseif ($res=="Error") {
		"No se pudo registrar la hora, Verifique los datos";
	}else{
		echo $res;
	}


}







