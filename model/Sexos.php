<?php
class Sexos{
	private $id;
	private $nombre;


	public function Sexos($id,$nombre){
		$this->id = $id;
		$this->nombre = $nombre;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}
}

