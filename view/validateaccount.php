<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    include '../controller/Controller.php';

    $c = new Controller();

    $token = str_replace("'","",$token);
    $consulta = $c->validateaccount($token);

        include '../templates/account_activated.php';
    
}

