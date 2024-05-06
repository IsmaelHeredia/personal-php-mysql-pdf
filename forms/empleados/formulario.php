<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("entities/Empleado.php");
include_once("data/empleadoDatos.php");
include_once("data/estadoCivilDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$empleadoDatos = new EmpleadoDatos();
$estadoCivilDatos = new EstadoCivilDatos();

$id = "";

if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
  $id = $_GET["id"];
}

$apellidos_nombres = "";
$fecha_nacimiento = "";
$id_estado_civil = "";
$sexo = "";
$calle_numero_domicilio = "";
$localidad = "";

if($id > 0) {
  $empleado = $empleadoDatos->Cargar($id);
  $id = $empleado->getId();
  $dni = $empleado->getDni();
  $apellidos_nombres = $empleado->getApellidosNombres();
  $fecha_nacimiento = $empleado->getFechaNacimiento();
  $id_estado_civil = $empleado->getIdEstadoCivil();
  $sexo = $empleado->getSexo();
  $calle_numero_domicilio = $empleado->getCalleNumeroDomicilio();
  $localidad = $empleado->getLocalidad();
}

$estados_civiles = $estadoCivilDatos->Listar();

?>

<div class="card contenedor">
  <div class="card-header">
    Datos del empleado
  </div>
  <div class="card-body">
    <form method="POST" id="formEmpleado" action="forms/empleados/datos.php">
      <input type="hidden" id="txtID" name="txtID" value="<?php echo htmlentities($id); ?>" />
      <div class="mb-3">
        <label for="txtDNI" class="form-label">DNI</label>
        <input type="number" class="form-control" id="txtDNI" name="txtDNI" value="<?php echo htmlentities($dni); ?>" required />
      </div>
      <div class="mb-3">
        <label for="txtApellidosNombres" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="txtApellidosNombres" name="txtApellidosNombres" value="<?php echo htmlentities($apellidos_nombres); ?>" required />
      </div>
      <div class="row">
        <div class="col">
          <label for="txtFechaNacimiento" class="form-label">Fecha Nacimiento</label>
          <input type="date" class="form-control" id="txtFechaNacimiento" name="txtFechaNacimiento" value="<?php echo htmlentities($fecha_nacimiento); ?>" required/>
        </div>
        <div class="col">
          <label for="cmbEstadoCivil" class="form-label">Estado Civil</label>
          <select class="form-select" id="cmbEstadoCivil" name="cmbEstadoCivil" required />
            <?php
              foreach($estados_civiles as $estado_civil) {
                $id_estado_civil_lista = $estado_civil->getId();
                $nombre_estado = $estado_civil->getNombre();
                if($id_estado_civil == $id_estado_civil_lista) {
                  echo "<option selected value='" . $id_estado_civil_lista  ."'>" . htmlentities($nombre_estado) . "</option>";
                } else {
                  echo "<option value='" . $id_estado_civil_lista  ."'>" . htmlentities($nombre_estado) . "</option>";
                }
              }
            ?>
          </select>    
        </div>
      </div>
      <div class="mt-3 mb-3 d-flex">
          <label for="txtSexo" class="form-label">Sexo</label>
          <div class="mx-3 form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbSexo" value="M" <?php if($sexo == "M" || $sexo == "") { echo "checked"; } ?> />
              <label class="form-check-label" for="inlineRadio1">Masculino</label>
          </div>
          <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbSexo" value="F" <?php if($sexo == "F") { echo "checked"; } ?> />
              <label class="form-check-label text-nowrap" for="inlineRadio2">Femenino</label>
          </div>
      </div>
      <div class="mb-3">
        <label for="txtCalleNumeroDomicilio" class="form-label">Calle y Número</label>
        <input type="text" class="form-control" id="txtCalleNumeroDomicilio" name="txtCalleNumeroDomicilio" value="<?php echo htmlentities($calle_numero_domicilio); ?>" required />
      </div>
      <div class="mb-3">
        <label for="txtLocalidad" class="form-label">Localidad</label>
        <input type="text" class="form-control" id="txtLocalidad" name="txtLocalidad" value="<?php echo htmlentities($localidad); ?>" required />
      </div>
      <div class="mt-5 text-center">
        <p class="lead">
          <button type="submit" id="guardar" name="guardar" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i> Guardar</button>
          <a class="btn btn-primary" href="index.php?tipo=listar" role="button"><i class="fa fa-rotate-left" aria-hidden="true"></i> Volver</a>
        </p>
      </div>
    </form>
  </div>
</div>