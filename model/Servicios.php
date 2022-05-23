<?php
class servicios{
	private $id_servicio;
	private $nombre_servicio;
	private $precio;


	public function servicios($id_servicio,$nombre_servicio,$precio){
		$this->id = $id_servicio;
		$this->nombre = $nombre_servicio;
		$this->precio = $precio;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getPrecio(){
		return $this->getPrecio;
	}
}