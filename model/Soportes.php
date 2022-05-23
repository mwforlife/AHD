<?php
class Soportes{
    private $id;
    private $nombre;
    private $correo;
    private $telefono;
    private $asunto;
    private $mensaje;
    private $hora;
    private $fecha;
    private $estado;

    public function Soportes($id, $nombre, $correo, $telefono, $asunto, $mensaje,$hora,$fecha,$estado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
        $this->hora = $hora;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getAsunto(){
        return $this->asunto;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function getHora(){
        return $this->hora;
    }
    
    public function getFecha(){
        return $this->fecha;
    }
    
    public function getEstado(){
        return $this->estado;
    }
}