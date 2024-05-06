<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("data/empleadoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

global $directorio_principal;
global $session_mensaje;

if(!isset($_SESSION)) { session_start(); }

$empleadoDatos = new EmpleadoDatos();
$helper = new Helper();

if(isset($_POST["guardar"])) {

  $id = $_POST["txtID"];
  $dni = $_POST["txtDNI"];
  $apellidos_nombres = $_POST["txtApellidosNombres"];
  $fecha_nacimiento = $_POST["txtFechaNacimiento"];
  $id_estado_civil = $_POST["cmbEstadoCivil"];
  $sexo = $_POST["rbSexo"];
  $calle_numero_domicilio = $_POST["txtCalleNumeroDomicilio"];
  $localidad = $_POST["txtLocalidad"];

  $empleado = Empleado::CreateEmpleado($id,$dni,$apellidos_nombres,$fecha_nacimiento,$id_estado_civil,$sexo,$calle_numero_domicilio,$localidad);

  if($id == "") {
    if(!is_numeric($dni) || strlen($dni) != 8) {
        $_SESSION[$session_mensaje] = "El DNI es incorrecto";
        header("Location: $directorio_principal/index.php?tipo=agregar");
    } else {
      if($empleadoDatos->comprobarExistenciaCrear($dni)) {
        $_SESSION[$session_mensaje] = "El empleado $apellidos_nombres ya existe";
        header("Location: $directorio_principal/index.php?tipo=agregar");
      } else {
        $id_empleado = $empleadoDatos->Agregar($empleado);
        $_SESSION[$session_mensaje] = "El empleado fue creado exitosamente";
        header("Location: $directorio_principal/index.php?tipo=listar");
      }
    }
  } else {
    if(!is_numeric($dni) || strlen($dni) != 8) {
      $_SESSION[$session_mensaje] = "El DNI es incorrecto";
      header("Location: $directorio_principal/index.php?tipo=editar&id=$id");      
    } else {
      if($empleadoDatos->comprobarExistenciaEditar($id,$dni)) {
        $_SESSION[$session_mensaje] = "El empleado $apellidos_nombres ya existe";
        header("Location: $directorio_principal/index.php?tipo=editar&id=$id");
      } else {
        $empleadoDatos->Editar($empleado);
        $_SESSION[$session_mensaje] = "El empleado fue editado exitosamente";
        header("Location: $directorio_principal/index.php?tipo=listar");
      }
    }
  }
}

if(isset($_POST["borrar"])) {
    $id = $_POST["id"];
    $empleadoDatos->Borrar($id);
    $_SESSION[$session_mensaje] = "El empleado fue borrado exitosamente";
    header("Location: $directorio_principal/index.php?tipo=listar");
}

?>