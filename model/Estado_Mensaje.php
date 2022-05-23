<?php
class Estado_mensaje{
	private $id;
	private $estado;

	public function Estado_mensaje($id,$estado){
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
