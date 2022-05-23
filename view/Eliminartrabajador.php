<?php
require '../controller/Controller.php';

$c = new Controller();

$id = $_POST['id'];

$res = $c->Eliminartrabajador($id);

echo $res;