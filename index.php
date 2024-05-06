<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("config/vars.php");
include_once("functions/helper.php");

$tipo = "";

if(isset($_GET["tipo"])) {
	$tipo = $_GET["tipo"];
	if($tipo == "exportar") {
		include_once("forms/exportar/pdf.php");
	} else {
		include_once("layouts/header.php");
		if($tipo == "listar") {
			include_once("forms/empleados/listar.php");
		}
		elseif($tipo == "agregar") {
			include_once("forms/empleados/formulario.php");
		}
		elseif($tipo == "editar") {
			include_once("forms/empleados/formulario.php");
		}
		elseif($tipo == "borrar") {
			include_once("forms/empleados/borrar.php");
		}
		elseif($tipo == "estadisticas") {
			include_once("forms/estadisticas/reporte.php");
		}
		include_once("layouts/footer.php");
	}
} else {
	include_once("layouts/header.php");
	echo "<h3 class=\"text-center\">Bienvenido</h3>";
	include_once("layouts/footer.php");
}

?>