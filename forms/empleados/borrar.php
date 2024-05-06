<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/empleadoDatos.php");

$empleadoDatos = new EmpleadoDatos();

$id = 0;

if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
  $id = $_GET["id"];
}

$empleado = $empleadoDatos->Cargar($id);

$dni = $empleado->getDni();
$apellidos_nombres = $empleado->getApellidosNombres();

?>

<div class="jumbotron">
  <form method="POST" action="forms/empleados/datos.php">
    <input type="hidden" id="id" name="id" value="<?php echo htmlentities($id); ?>" />
    <fieldset>
        <div class="text-center">
            <h1>Eliminacíon</h1>
            <p class="lead">¿Estás seguro que deseas eliminar al empleado <?php echo htmlentities($apellidos_nombres); ?> con DNI <?php echo htmlentities($dni); ?> ?</p>
            <p class="lead">
                <button type="submit" id="borrar" name="borrar" class="btn btn-danger boton-largo"><i class="fa fa-trash" aria-hidden="true"></i> Borrar</button>
                <a class="btn btn-primary boton-largo" href="index.php?tipo=listar" role="button"><i class="fa fa-rotate-left" aria-hidden="true"></i> Volver</a>
            </div>
        </div>
    </fieldset>
  </form>
</div>