<?php
class Telefonos{

	private $id;
	private $id_peluqueria;
	private $numero;

	public function Telefonos($id,$id_peluqueria,$numero){
		$this->id = $id;
		$this->id_peluqueria = $id_peluqueria;
		$this->numero = $numero;
	}


	public function getId(){
		return $this->id;
	}

	public function getId_Peluqueria(){
		return $this->id_peluqueria;
	}

	public function getNumero(){
		return $this->numero;
	}



}

