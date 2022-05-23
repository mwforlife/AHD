<?php
session_start();
include '../controller/Controller.php';

$c = new Controller();

 $id_pel = $_SESSION['men_is_pel'];
 $id_usu = $_SESSION['men_is_usu'];

 $msg = $_POST['msg'];
 $estado = $_POST['estado'];

 $men = new Mensaje(0,$id_usu,$id_pel,$msg,$estado,0,0);

 $res = $c->send_client_message($men);

 if($res==1){
     echo 1;
 }else{
     echo $res;
 }