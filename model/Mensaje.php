<?php
class Mensaje{
	private $id_mensaje;
	private $id_usuario;
	private $id_peluqueria;
	private $texto_mensaje;
	private $id_estado;
	private $hora;
	private $fecha;

	public function Mensaje($id_mensaje,$id_usuario,$id_peluqueria,$texto_mensaje,$id_estado,$hora,$fecha){
		$this->id_mensaje = $id_mensaje;
		$this->id_usuario = $id_usuario;
		$this->id_peluqueria = $id_peluqueria;
		$this->texto_mensaje = $texto_mensaje;
		$this->id_estado = $id_estado;
		$this->hora = $hora;
		$this->fecha = $fecha;
	}

	public function getId_mensaje(){
		return $this->id_mensaje;
	}

	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function getId_peluqueria(){
		return $this->id_peluqueria;
	}

	public function getTexto_mensaje(){
		return $this->texto_mensaje;
	}

	public function getId_estado(){
		return $this->id_estado;
	}

	public function getHora(){
		return $this->hora;
	}

	public function getFecha(){
		return $this->fecha;
	}
}