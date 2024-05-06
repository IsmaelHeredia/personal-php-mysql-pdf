<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/conexion.php");
include_once("entities/empleado.php");
include_once("entities/estadoCivil.php");

class EmpleadoDatos {

	 public function __construct() {

	 }

   public function Listar($dni) {
      $empleados = array();
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();

      $sql = null;

      if(is_numeric($dni)) {
        $sql = $conn->prepare('SELECT * FROM empleados WHERE dni LIKE :patron');
        $sql->execute(array('patron' => '%'.$dni.'%'));
      } else {
        $sql = $conn->prepare('SELECT * FROM empleados');
        $sql->execute();        
      }

      $resultado = $sql->fetchAll();
      foreach ($resultado as $fila) {
        $id = $fila['id'];
        $dni = $fila['dni'];
        $apellidos_nombres = $fila['apellidos_nombres'];
        $fecha_nacimiento = $fila['fecha_nacimiento'];
        $id_estado_civil = $fila['id_estado_civil'];
        $sexo = $fila['sexo'];
        $calle_numero_domicilio = $fila['calle_numero_domicilio'];
        $localidad = $fila['localidad'];
        $empleado = Empleado::CreateEmpleado($id,$dni,$apellidos_nombres,$fecha_nacimiento,$id_estado_civil,$sexo,$calle_numero_domicilio,$localidad);
        array_push($empleados,$empleado);
      }
      foreach ($empleados as $empleado) {
        $sql = $conn->prepare('SELECT * FROM estados_civiles WHERE id = :id');
        $sql->execute(array('id' => $empleado->getIdEstadoCivil()));
        $resultado = $sql->fetch();  
        $id = $resultado['id'];
        $nombre = $resultado['nombre'];
        $estado_civil = EstadoCivil::CreateEstadoCivil($id,$nombre);
        $empleado->setEstadoCivil($estado_civil);     
      }
      $conexion->cerrar_conexion();
      return $empleados;   
   }

   public function Cargar($id) {
   	  $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM empleados WHERE id = :id');
      $sql->execute(array('id' => $id));
      $resultado = $sql->fetch();
      $id = $resultado['id'];
      $dni = $resultado['dni'];
      $apellidos_nombres = $resultado['apellidos_nombres'];
      $fecha_nacimiento = $resultado['fecha_nacimiento'];
      $id_estado_civil = $resultado['id_estado_civil'];
      $sexo = $resultado['sexo'];
      $calle_numero_domicilio = $resultado['calle_numero_domicilio'];
      $localidad = $resultado['localidad'];
      $empleado = Empleado::CreateEmpleado($id,$dni,$apellidos_nombres,$fecha_nacimiento,$id_estado_civil,$sexo,$calle_numero_domicilio,$localidad);
      $sql = $conn->prepare('SELECT * FROM estados_civiles WHERE id = :id');
      $sql->execute(array('id' => $empleado->getIdEstadoCivil()));
      $resultado = $sql->fetch();  
      $id = $resultado['id'];
      $nombre = $resultado['nombre'];
      $estado_civil = EstadoCivil::CreateEstadoCivil($id,$nombre);
      $empleado->setEstadoCivil($estado_civil);  
      $conexion->cerrar_conexion();
      return $empleado;   
   }  

   public function Agregar($empleado) {
      $dni = $empleado->getDni();
      $apellidos_nombres = $empleado->getApellidosNombres();
      $fecha_nacimiento = $empleado->getFechaNacimiento();
      $id_estado_civil = $empleado->getIdEstadoCivil();
      $sexo = $empleado->getSexo();
      $calle_numero_domicilio = $empleado->getCalleNumeroDomicilio();
      $localidad = $empleado->getLocalidad();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('INSERT INTO empleados(dni,apellidos_nombres,fecha_nacimiento,id_estado_civil,sexo,calle_numero_domicilio,localidad) VALUES(:dni,:apellidos_nombres,:fecha_nacimiento,:id_estado_civil,:sexo,:calle_numero_domicilio,:localidad)');
        $sql->execute(array('dni' => $dni,'apellidos_nombres' => $apellidos_nombres,'fecha_nacimiento' => $fecha_nacimiento,'id_estado_civil' => $id_estado_civil,'sexo'=>$sexo,'calle_numero_domicilio'=>$calle_numero_domicilio,'localidad'=>$localidad)); 
        $conexion->cerrar_conexion();
        return $conn->lastInsertId();
      } catch (PDOException $e) {
        return false;
      }     
   }

   public function Editar($empleado) {
      $id = $empleado->getId();
      $dni = $empleado->getDni();
      $apellidos_nombres = $empleado->getApellidosNombres();
      $fecha_nacimiento = $empleado->getFechaNacimiento();
      $id_estado_civil = $empleado->getIdEstadoCivil();
      $sexo = $empleado->getSexo();
      $calle_numero_domicilio = $empleado->getCalleNumeroDomicilio();
      $localidad = $empleado->getLocalidad();
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('UPDATE empleados SET dni = :dni, apellidos_nombres = :apellidos_nombres, fecha_nacimiento = :fecha_nacimiento, id_estado_civil = :id_estado_civil, sexo = :sexo, calle_numero_domicilio = :calle_numero_domicilio, localidad = :localidad WHERE id = :id');
        $sql->execute(array('dni' => $dni,'apellidos_nombres' => $apellidos_nombres,'fecha_nacimiento' => $fecha_nacimiento,'id_estado_civil' => $id_estado_civil,'sexo'=>$sexo,'calle_numero_domicilio'=>$calle_numero_domicilio,'localidad'=>$localidad,'id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function Borrar($id) {
      try {
        $conexion = new Conexion();
        $conexion->abrir_conexion();
        $conn = $conexion->retornar_conexion();
        $sql = $conn->prepare('DELETE FROM empleados WHERE id = :id');
        $sql->execute(array('id'=>$id)); 
        $conexion->cerrar_conexion();
        return true;
      } catch (PDOException $e) {
        return false;
      } 
   }

   public function comprobarExistenciaCrear($dni) {
      $response = false;
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM empleados WHERE dni = :dni');
      $sql->execute(array('dni' => $dni));
      $resultado = $sql->fetchAll();
      $cantidad = count($resultado);
      if($cantidad >= 1) {
        $response = true;
      } else {
        $response = false;
      }
      $conexion->cerrar_conexion();
      return $response;
   }

   public function comprobarExistenciaEditar($id,$dni) {
      $response = false;
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $conn = $conexion->retornar_conexion();
      $sql = $conn->prepare('SELECT * FROM empleados WHERE dni = :dni AND id != :id');
      $sql->execute(array('dni' => $dni,'id' => $id));
      $resultado = $sql->fetchAll();
      $cantidad = count($resultado);
      if($cantidad >= 1) {
        $response = true;
      } else {
        $response = false;
      }
      $conexion->cerrar_conexion();
      return $response;
   }
            	   
   public function __destruct(){
   }  

}

?>