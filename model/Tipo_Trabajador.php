<?php
class Tipo_Trabajador{
	private $id;
	private $tipo;

	public function Tipo_Trabajador($id,$tipo){
		$this->id =$id;
		$this->tipo = $tipo;

	}

	public function getId(){
		return $this->id;
	}

	public function getTipo(){
		return $this->tipo;
	}
}