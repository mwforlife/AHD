<?php
require_once '../controller/Controller.php';
session_start();

$c = new controller();

$id = $_SESSION['id_usu'];

$u = $c->buscarUsuario($id);

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Nombre:</label>";
echo "<input readonly type='text' class='form-control' name='nommod' value='".$u->getNombre()."'>";
echo "</div>";
echo "</div>";


echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Apellido:</label>";
echo "<input readonly type='text' class='form-control' name='apemod' value='".$u->getApellido()."'>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Nombre de Usuario:</label>";
echo "<input readonly type='text' class='form-control' name='usumod' value='".$u->getLogin()."'>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Edad:</label>";
echo "<input readonly type='text' class='form-control' name='edamod' value='".$u->getFec_nac()."'>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Sexo:</label>";
if ($u->getSexo()==1) {
    echo "<input readonly type='text' class='form-control' name='sexmod' value='Masculino'>";
}else{
    echo "<input readonly type='text' class='form-control' name='sexmod' value='Feminino'>";

}
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Telefono:</label>";
echo "<input readonly type='text' class='form-control' name='telmod' value='".$u->getTelefono()."'>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Region:</label>";
echo "<select disabled name='regmod' class='form-control'>";
$lista = $c->ListarRegiones();

for ($i=0; $i <count($lista) ; $i++) { 
	$r = $lista[$i];
    if($r->getId()==$u->getId_reg()){
        echo "<option selected value='".$r->getId()."'>".$r->getNombre()."</option>";
    }else{
	echo "<option value='".$r->getId()."'>".$r->getNombre()."</option>";
    }
}
echo "</select>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Comuna:</label>";
echo "<select disabled class='form-control'>";
$lista = $c->ListarComunas($u->getId_reg());

for ($i=0; $i <count($lista) ; $i++) { 
	$co = $lista[$i];
    if($u->getId_com()==$co->getId()){
        echo "<option selected value='".$co->getId()."'>".$co->getNombre()."</option>";
    }else{
	echo "<option value='".$co->getId()."'>".$co->getNombre()."</option>";
}}
echo "</select>";
echo "</div>";
echo "</div>";


echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Region:</label>";
echo "<input disabled type='text' class='form-control' name='dirmod' value='".$u->getDireccion()."'>";
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col'>";
echo "<label>Nombre:</label>";
echo "<input readonly type='text' class='form-control' name='nommod' value='".$u->getCorreo()."'>";
echo "</div>";
echo "</div>";