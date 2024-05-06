<?php

class EstadoCivil {

  private $id;
  private $nombre;

  public function __construct(){
    $this->id = "";
		$this->nombre = "";
   }

  public static function CreateEstadoCivil($id,$nombre) {
   		$instance = new self();
    	$instance->id = $id;
		  $instance->nombre = $nombre;
    	return $instance;
  }

  public function getId() {
    	return $this->id;
  }

  public function setId($id) {
    	$this->id = $id;
  }
  
  public function getNombre() {
   	 	return $this->nombre;
  }

  public function setNombre($nombre) {
    	$this->nombre = $nombre;
  }
    
  public function __destruct(){
    $this->id = "";
		$this->nombre = "";
   }  
   
   public function toString() {
		return "EstadoCivil{" . "id=" . $this->id . ", nombre=" . $this->nombre . '}';
   }
  
}

?>