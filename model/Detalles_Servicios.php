<?php
class Detalles_Servicios{
	private $id;
	private $id_servicios;
	private $id_peluqueria;
	private $precio;



	public function Detalles_Servicios($id,$id_servicios,$id_peluqueria,$precio){
		$this->id = $id;
		$this->id_servicios = $id_servicios;
		$this->id_peluqueria = $id_peluqueria;
		$this->precio = $precio;
	}


	public function getid(){
		return $this->id;
	}

	public function getId_servicios(){
		return $this->id_servicios;
	}

	public function getId_peluqueria(){
		return $this->id_peluqueria;
	}

	public function getPrecio(){
		return $this->precio;
	}

}


