<?php
include '../controller/Controller.php';

$c = new Controller();

$id = $_POST['txt_ind'];
$nombre = $_POST['nom_usu'];
$apellido = $_POST['ape_usu'];
$login = $_POST['log_usu'];
$pass = sha1($_POST['pas_usu']);
$fec_nac = $_POST['eda_usu'];
$sex = $_POST['id_sex'];
$telefono = $_POST['tel_usu'];
$region = $_POST['region'];
$comuna = $_POST['comuna'];
$direccion = $_POST['dir'];
$correo = $_POST['cor_usu'];
$token = sha1($correo);

$u = new Usuarios($id,$nombre,$apellido,$login,$pass,$fec_nac,$sex,$telefono,$region,$comuna,$direccion,$correo,$token,0,0,0);

$result = $c->registrarusuario($u);

if($result==6){
    echo 6;
}else if($result=='true'){
    echo 3;
     // allow for demo mode testing of emails
     define("DEMO", false); // setting to TRUE will stop the email from sending.

     // set the location of the template file to be loaded
     $template_file = "../templates/welcome_template.php";
 
     // set the email 'from' information
     $email_from = "AHD Hairdresser - Nuevo Style <ahd@wilkenstech.host>";
 
     // create a list of the variables to be swapped in the html template
     $swap_var = array(
         "{SITE_ADDR}" => "https://www.wilkenstech.host",
         "{EMAIL_LOGO}" => "https://wilkenstech.host/AHD2.0/img/logo/logo.png",
         "{EMAIL_TITLE}" => "Su Cuenta ha sido creada con exito",
         "{CUSTOM_URL}" => "https://wilkenstech.host/AHD2.0/view/validateaccount.php?token='$token'",
         "{CUSTOM_IMG}" => "",
         "{TO_NAME}" => $nombre,
         "{TO_EMAIL}" => $correo
     );
 
     // create the email headers to being the email
     $email_headers = "From: ".$email_from."\r\nReply-To: ".$email_from."\r\n";
     $email_headers .= "MIME-Version: 1.0\r\n";
     $email_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
     // load the email to and subject from the $swap_var
     $email_to =$correo;
     $email_subject = $swap_var['{EMAIL_TITLE}']; // you can add time() to get unique subjects for testing: time();
 
     // load in the template file for processing (after we make sure it exists)
     if (file_exists($template_file)){
         $email_message = file_get_contents($template_file);
     }else{
         die ("Unable to locate your template file");
    }
     // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
     foreach (array_keys($swap_var) as $key){
         if (strlen($key) > 2 && trim($swap_var[$key]) != '')
             $email_message = str_replace($key, $swap_var[$key], $email_message);
     }
 
     // check if the email script is in demo mode, if it is then dont actually send an email
     if (DEMO){
         die("<hr /><center>This is a demo of the HTML email to be sent. No email was sent. </center>");
     }
     // send the email out to the user   
    mail($email_to, $email_subject, $email_message, $email_headers);
 
}else if($result=='false'){
    echo "No se pudo registrar Verifique los datos por favor";
}
