<?php
require '../controller/Controller.php';

$c = new controller();

  session_start();

$id = $_SESSION['user_pel'];

$lista = $c->listartrabajadores($id);

if($lista==null){
    echo "<tr><td colspan='6' class='text-center'>No hay trabajadores registrados</td></tr>";
}else{
    for ($i=0; $i <count($lista) ; $i++) { 
      $t = $lista[$i];
      echo "<tr>";
      echo "<td>".$t->getId()."</td>";
      echo "<td>".$t->getNombre()." ".$t->getApellido()."</td>";
      echo "<td>".$t->getTipo()."</td>";
      echo "<td>".$t->getEdad()."</td>";
      echo "<td>".$t->getDireccion()."</td>";
      echo "<td>".$t->getCreated()."</td>";
      echo "<td><img class='profile_picture' src='../img/image_server/workers_profile/".$t->getFoto()."'</td>";
      echo "<td><button class='btn btn-warning'><img src='../img/iconos/pen.png' height='30' width='30'></button>
        <button onclick='eliminartrabajador('".$t->getId()."')' class='btn btn-danger'><img src='../img/iconos/delete.png' height='30' width='30'></button>
        <button class='btn btn-success'><img src='../img/iconos/confirm.png' height='30' width='30'></button></td>";
      echo "</tr>";
    }
}