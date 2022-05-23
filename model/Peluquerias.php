<?php
class Peluquerias{
	private $id;
	private $nombre;
	private $login;
	private $password;
	private $representante;
    private $id_reg;
    private $id_com;
	private $direccion;
	private $correo;
	private $ult_vis;
	private $estado;
	private $created;


	public function Peluquerias($id,$nombre,$login,$password,$representante,$id_reg,$id_com,$direccion,$correo,$ult_vis,$estado,$created){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->login = $login;
		$this->password = $password;
		$this->representante = $representante;
        $this->id_reg = $id_reg;
        $this->id_com = $id_com;
		$this->direccion = $direccion;
		$this->correo = $correo;
		$this->ult_vis = $ult_vis;
		$this->estado = $estado;
		$this->created = $created;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getRepresentante(){
		return $this->representante;
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
	public function getCorreo(){
		return $this->correo;
	}

	public function getUlt_vis(){
		return $this->ult_vis;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function getCreated(){
		return $this->created;
	}
	
}

