<?php
include '../controller/Controller.php';

$login = $_POST['nom_usu'];
$password = sha1($_POST['pas_usu']);
$c = new Controller();

$res = $c->comprobarusuario($login,$password);

if ($res == "Paso") {
    echo "Suspendido";
}else{
    $resultado = $c->Login_Usuario($login, $password);
    if ($resultado == 1) {
        echo "Exito";
    }else{
        echo "Error";
    }
}