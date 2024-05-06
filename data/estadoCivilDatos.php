<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/conexion.php");
include_once("entities/estadoCivil.php");

class EstadoCivilDatos {

    public function __construct() {

    }

   public function Listar() {
      $estados_civiles = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();

      $sql = $conn->prepare('SELECT * FROM estados_civiles');
      $sql->execute();  

      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $nombre = $fila['nombre'];
        $estado_civil = EstadoCivil::CreateEstadoCivil($id,$nombre);
        array_push($estados_civiles,$estado_civil);
      }
      $conexion->cerrar_conexion();
      return $estados_civiles;   
   }
            	   
   public function __destruct(){
   }  

}

?>