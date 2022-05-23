<?php
require_once '../controller/Controller.php';

$c=new controller();

session_start();

$id = $_SESSION['id_usu'];

$c->eliminarcuenta($id);


