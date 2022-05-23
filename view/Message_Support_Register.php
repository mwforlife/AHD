<?php
require '../controller/Controller.php';

$nombre = $_POST['name'];
$correo = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$c = new Controller();

$s = new Soportes(0,$nombre,$correo,$phone,$subject,$message,0,0,1);

$res = $c->Message_Support_Register($s);

echo $res;
