<?php
include '../controller/Controller.php';

$login = $_POST['nom_usu'];
$password = sha1($_POST['con_usu']);
$c = new Controller();

    $resultado = $c->Login_Recepcionista($login, $password);
    if ($resultado == 1) {
        echo "Exito";
    }else if($resultado==0){
        echo "Error";
    }else{
        echo $resultado;
    }

