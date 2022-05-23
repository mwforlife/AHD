<?php
require_once '../controller/Controller.php';

session_start();

$c = new controller();

$id = $_SESSION['id_usu'];

$lista = $c->listarreserva2($id);

if($lista==null){
    echo "<tr><td colspan='7'>No Tienes reservas registradas</td></tr>";
}else{
    for ($i=0; $i <count($lista) ; $i++) { 
        $r = $lista[$i];
        echo "<tr>";
        echo "<td>".($i+1)."</td>";
        echo "<td>".$r->getId_servicio()."</td>";
        echo "<td>".$r->getid_peluqueria()."</td>";
        echo "<td>".$r->getFecha()."</td>";
        echo "<td>".$r->getHora()."</td>";
        echo "<td>".$r->getId_estado()."</td>";
        echo "<td>";
        echo "<button class='btn btn-danger' onclick='eliminar(".$r->getId_servicio().")'><img src='../img/iconos/uncheck.svg' height='30' width='30'></button>";
        echo "</td>";
        echo "</tr>";
    }
}
