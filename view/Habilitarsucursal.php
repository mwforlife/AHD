<?php
require_once '../controller/Controller.php';

$c=new controller();

session_start();

   $id= $_POST['pel'];


$c->Habilitarsucursal($id);


