<?php
require '../controller/Controller.php';

$c = new Controller();

$id = $_POST['id'];

$res = $c->CancelarReserva($id);

echo $res;