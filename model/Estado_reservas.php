<?php
class Estado_Reservas{
	private $id;
	private $estado;

	public function Estado_Reservas($id,$estado){
		$this->id = $id;
		$this->estado = $estado;
	}

	public function getId(){
		return $this->id;
	}

	public function getEstado(){
		return $this->estado;
	}
}