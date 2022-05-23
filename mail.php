<?php
$paracorreo = "wilkenstech@gmail.com";
$titulo = "Saludo";
$mensaje = "Hola mundo";
$tucorreo = "From: mwforlife24@gmail.com";

if (mail($paracorreo, $titulo, $mensaje, $tucorreo)) {
    echo "Correo enviado";
}else{
    echo "Error";
}













