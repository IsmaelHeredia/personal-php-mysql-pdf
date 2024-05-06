<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/empleadoDatos.php");
include_once("functions/Helper.php");

$helper = new Helper();

$empleadoDatos = new EmpleadoDatos();

$dni = "";

if(isset($_GET["buscar"]) && is_numeric($_GET["buscar"])) {
	$dni = $_GET["buscar"];
}

$empleados = $empleadoDatos->Listar($dni);

?>

<div class="card contenedor">
  <div class="card-header">
    Lista de empleados
  </div>
  <div class="card-body">

  	<form method="GET">
  		<div class="d-flex align-items-center justify-content-center" style="margin-bottom: 50px;">
	  		<div class="row">
		      <div class="col-lg-8">
		      	<input type="hidden" id="tipo" name="tipo" value="listar">
		        <input type="number" class="form-control" id="buscar" name="buscar" placeholder="Ingrese DNI" value="<?php echo htmlentities($dni); ?>" />
		      </div>
		      <div class="col">
		        <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass" aria-hidden="true"></i> Buscar</button>
		      </div>
		    </div>
	  	</div>
  	</form>

<?php

if(count($empleados) > 0) {

	?>

	<table class="table table-striped nowrap" style="width:100%">
	  <thead>
	    <tr>
	      <th scope="col">DNI</th>
	      <th scope="col">Apellidos y Nombres</th>
	      <th scope="col">Fecha de Nacimiento</th>
	      <th scope="col">Estado Civil</th>
	      <th scope="col">Sexo</th>
	      <th scope="col">Localidad</th>
	      <th scope="col">Opción</th>
	    </tr>
	  </thead>
	  <tbody>

	<?php

	foreach($empleados as $empleado) {
		$id = $empleado->getId();
		$dni_em = $empleado->getDni();
		$apellidos_nombres = $empleado->getApellidosNombres();
		$fecha_nacimiento = $helper->convertir_fecha_usuario($empleado->getFechaNacimiento());
		$estado_civil = $empleado->getEstadoCivil()->getNombre();
		$sexo = ($empleado->getSexo() == "M" ? "Masculino" : "Femenino");
		$localidad = $empleado->getLocalidad();
		echo "<tr><td>". htmlentities($dni_em) ."</td><td>". htmlentities($apellidos_nombres) ."</td><td>". htmlentities($fecha_nacimiento) ."</td><td>". htmlentities($estado_civil) ."</td><td>". htmlentities($sexo) ."</td><td>". htmlentities($localidad) ."</td><td><a class=\"btn btn-primary\" href=\"index.php?tipo=editar&id=". htmlentities($id) ."\" role=\"button\"><i class=\"fa fa-pen\" aria-hidden=\"true\"></i> Editar</a>&nbsp;<a class=\"btn btn-primary\" href=\"index.php?tipo=borrar&id=". htmlentities($id) ."\" role=\"button\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Borrar</a></td></tr>";
	}

	?>

		  </tbody>
		</table>

		<a class="btn btn-primary" href="index.php?tipo=exportar&buscar=<?php echo htmlentities($dni); ?>" role="button" target="_blank"><i class="fa fa-file-pdf" aria-hidden="true"></i> Exportar PDF</a>

	<?php

} else {
	echo "<h4 class=\"text-center\">Registro Inexistente</h4>";
}

?>

  </div>
</div>

<div class="mt-5 col-md-12 text-center">
	<a class="btn btn-primary" href="index.php?tipo=agregar" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo empleado</a>
</div>