<?php
class Reserva{
private $id_reserva;
private $id_peluqueria;
private $id_estado;
private $id_servicio;
private $id_usuario;
private $hora;
private $fecha;
private $trabajador;


public function Reserva($id_reserva,$id_peluqueria,$id_estado,$id_servicio,$id_usuario,$hora,$fecha,$trabajador){
	$this->id_reserva = $id_reserva;
	$this->id_peluqueria = $id_peluqueria;
	$this->id_estado = $id_estado;
	$this->id_servicio = $id_servicio;
	$this->id_usuario = $id_usuario;
	$this->hora = $hora;
	$this->fecha = $fecha;
    $this->trabajador = $trabajador;
}

public function getId_reserva(){
	return $this->id_reserva;
}

public function getId_peluqueria(){
	return $this->id_peluqueria;
}

public function getId_estado(){
	return $this->id_estado;
}

public function getId_servicio(){
	return $this->id_servicio;
}

public function getId_usuario(){
	return $this->id_usuario;
}

public function getHora(){
	return $this->hora;
}

public function getFecha(){
	return $this->fecha;
}
    
public function getTrabajador(){
    return $this->trabajador;
}
}
