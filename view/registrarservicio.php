<?php
require '../controller/Controller.php';

$ser = $_POST['servicio'];
$pre = $_POST['pre'];

$c = new Controller();

$res = $c->registrarservicio($ser,$pre);

echo $res;