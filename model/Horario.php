<?php
class Horario{
	private $id_horario;
	private $id_peluqueria;
	private $contexto;
	private $hora_inicio;
	private $hora_termino;


	public function Horario($id_horario,$id_peluqueria,$contexto,$hora_inicio,$hora_termino){
		$this->id_horario = $id_horario;
		$this->id_peluqueria = $id_peluqueria;
		$this->contexto = $contexto;
		$this->hora_inicio = $hora_inicio;
		$this->hora_termino = $hora_termino;
	}


	public function getId_horario(){
		return $this->id_horario;
	}

	public function getId_peluqueria(){
		return $this->id_peluqueria;
	}

	public function getContexto(){
		return $this->contexto;
	}

	public function gethora_inicio(){
		return $this->hora_inicio;
	}

	public function getHora_termino(){
		return $this->hora_termino;
	}
}