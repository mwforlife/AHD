<?php
require_once '../controller/Controller.php';
session_start();

$usu = $_SESSION['id_usu'];
$c = new controller();

$pas = $_POST['pas'];

$c->modificarcontrasena($pas,$usu);
