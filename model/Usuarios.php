<?php
class Usuarios{
	private $id_usuario;
	private $nombre;
	private $apellido;
	private $login;
	private $password;
	private $fec_nac;
	private $sexo;
	private $telefono;
    private $id_reg;
    private $id_com;
    private $direccion;
	private $correo;
	private $token;
	private $reporte;
	private $created;

	public function Usuarios($id_usuario,$nombre,$apellido,$login,$password,$fec_nac,$sexo,$telefono,$id_reg,$id_com,$direccion,$correo,$token,$reporte,$created){
		$this->id_usuario = $id_usuario;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->login = $login;
		$this->password = $password;
		$this->fec_nac = $fec_nac;
		$this->sexo = $sexo;
		$this->telefono = $telefono;
        $this->id_reg=$id_reg;
        $this->id_com=$id_com;
        $this->direccion=$direccion;
		$this->correo = $correo;
		$this->token = $token;
		$this->reporte = $reporte;
		$this->created = $created;
	}

	public function getId_Usuario(){
		return $this->id_usuario;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getFec_nac(){
		return $this->fec_nac;
	}

	public function getSexo(){
		return $this->sexo;
	}

	public function getTelefono(){
		return $this->telefono;
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

	public function getToken(){
		return $this->token;
	}

	public function getReporte(){
		return $this->reporte;
	}

	public function getcreated(){
		return $this->created;
	}

}
