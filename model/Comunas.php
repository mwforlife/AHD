<?php
class Comunas{
    private $id;
    private $nombre;
    
    public function Comunas($id,$nombre,$id_reg){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->id_reg=$id_reg;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getId_reg(){
        return $this->id_reg;
    }
    
    public function setId($id){
        $this->id=$id;
    }
    
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    
    public function setId_reg($id_reg){
        $this->id_reg=$id_reg;
    }
}