<?php
include '../controller/Controller.php';

$c = new Controller();

session_start();
//Id del Usuario
$id_usu = $_SESSION['id_usu'];
//Id de la sucursal
$id_pel = $_POST['id'];

$res = $c->cant_message($id_usu,$id_pel);

if ($res==0) {
    echo "0 Mensaje";
}elseif($res>0){
    echo $res." Mensajes";
}