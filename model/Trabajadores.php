<?php
class Trabajadores{
	private $id;
	private $nombre;
	private $apellido;
	private $fec_nac;
    private $id_reg;
    private $id_com;
	private $direccion;
	private $tipo;
    private $foto;
	private $ult_vis;
	private $created;

	public function Trabajadores($id,$nombre,$apellido,$fec_nac,$id_reg,$id_com,$direccion,$tipo,$foto,$ult_vis,$created){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->fec_nac = $fec_nac;
        $this->id_reg = $id_reg;
        $this->id_com = $id_com;
		$this->direccion = $direccion;
		$this->tipo = $tipo;
        $this->foto = $foto;
		$this->ult_vis = $ult_vis;
		$this->created = $created;

	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getFecnac(){
		return $this->fec_nac;
	}

    public function getId_reg(){
        return $this->id_reg;
    }
    
    public function getId_com(){
        return $this->id_com;
    }

	public function getDireccion(){
		return $this->direccion;
	}
	public function getTipo(){
		return $this->tipo;
	}
    
    public function getFoto(){
        return $this->foto;
    }

	public function getUlt_vis(){
		return $this->ult_vis;
	}

	public function getCreated(){
		return $this->created;
	}
}
