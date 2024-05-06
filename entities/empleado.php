<?php

class Empleado
{
    
    private $id;
    private $dni;
    private $apellidos_nombres;
    private $fecha_nacimiento;
    private $id_estado_civil;
    private $sexo;
    private $calle_numero_domicilio;
    private $localidad;

    private $estado_civil;
    
    public function __construct()
    {
        $this->id = "";
        $this->dni = "";
        $this->apellidos_nombres = "";
        $this->fecha_nacimiento = "";
        $this->id_estado_civil = "";
        $this->sexo = "";
        $this->calle_numero_domicilio = "";
        $this->localidad = "";

        $this->estado_civil = "";
    }
    
    public static function CreateEmpleado($id, $dni, $apellidos_nombres, $fecha_nacimiento, $id_estado_civil, $sexo, $calle_numero_domicilio, $localidad)
    {
        $instance = new self();
        $instance->id = $id;
        $instance->dni = $dni;
        $instance->apellidos_nombres = $apellidos_nombres;
        $instance->fecha_nacimiento = $fecha_nacimiento;
        $instance->id_estado_civil = $id_estado_civil;
        $instance->sexo = $sexo;
        $instance->calle_numero_domicilio = $calle_numero_domicilio;
        $instance->localidad = $localidad;
        return $instance;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDni()
    {
        return $this->dni;
    }
    
    public function setDni($dni)
    {
        $this->dni = $dni;
    }
    
    public function getApellidosNombres()
    {
        return $this->apellidos_nombres;
    }
    
    public function setApellidosNombres($apellidos_nombres)
    {
        $this->apellidos_nombres = $apellidos_nombres;
    }
    
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }
    
    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    
    public function getIdEstadoCivil()
    {
        return $this->id_estado_civil;
    }
    
    public function setIdEstadoCivil($id_estado_civil)
    {
        $this->id_estado_civil = $id_estado_civil;
    }
    
    public function getSexo()
    {
        return $this->sexo;
    }
    
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getCalleNumeroDomicilio()
    {
        return $this->calle_numero_domicilio;
    }
    
    public function setCalleNumeroDomicilio($calle_numero_domicilio)
    {
        $this->calle_numero_domicilio = $calle_numero_domicilio;
    }
    
    public function getLocalidad()
    {
        return $this->localidad;
    }
    
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }
    
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }
    
    public function setEstadoCivil($estado_civil)
    {
        $this->estado_civil = $estado_civil;
    }

    public function __destruct()
    {
        $this->id = "";
        $this->dni = "";
        $this->apellidos_nombres = "";
        $this->fecha_nacimiento = "";
        $this->id_estado_civil = "";
        $this->sexo = "";
        $this->calle_numero_domicilio = "";
        $this->localidad = "";

        $this->estado_civil = "";
    }
    
    public function toString()
    {
        return "Empleado{" . "id=" . $this->id . ", dni=" . $this->dni . ", apellidos_nombres=" . $this->apellidos_nombres . ", fecha_nacimiento=" . $this->fecha_nacimiento . ", id_estado_civil=" . $this->id_estado_civil . ", sexo=" . $this->sexo . ", calle_numero_domicilio=" . $this->calle_numero_domicilio . " ,localidad=" . $this->localidad . '}';
    }
    
}

?>