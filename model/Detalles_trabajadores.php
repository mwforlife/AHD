<?php
class Detalles_trabajadores{
	private $id;
	private $id_peluqueria;
	private $id_trabajador;
    private $usuario;
    private $contrasena;
    private $sueldo;
    private $correo;
    private $telefono;
    private $ini_con;
    private $ini_term;

	public function Detalles_trabajadores($id, $id_peluqueria, $id_trabajador,$usuario,$contrasena, $sueldo, $correo, $telefono,$ini_con, $ini_term){
		$this->id = $id;
		$this->id_peluqueria = $id_peluqueria;
		$this->id_trabajador = $id_trabajador;
        $this->usuario = $usuario;
        $this->contrasena= $contrasena;
        $this->sueldo = $sueldo;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->ini_con = $ini_con;
        $this->ini_term = $ini_term;
	}

	public function getId(){
		return $this->id;
	}

	public function getId_peluqueria(){
		return $this->id_peluqueria;
	}

	public function getId_trabajador(){
		return $this->id_trabajador;
	}

    public function getUsuario(){
        return $this->usuario;
    }
    
    public function getContrasena(){
        return $this->contrasena;
    }
    
    public function getSueldo(){
        return $this->sueldo;
    }
    
    public function getCorreo(){
        return $this->correo;
    }
    
    public function getTelefono(){
        return $this->telefono;
    }

    public function getIni_con(){
        return $this->ini_con;
    }

    public function getIni_term(){
        return $this->ini_term;
    }
}


?>