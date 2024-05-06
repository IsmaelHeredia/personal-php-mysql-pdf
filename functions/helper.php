<?php

while (! file_exists("functions")) {
    chdir("..");
}

include_once("config/vars.php");

class Helper {

	public function __construct() {
	}

	function enviar_fecha_actual() {
		date_default_timezone_set("America/Argentina/Cordoba");
		$fecha = date("Y-m-d", time());
		return $fecha;
	}

	function convertir_fecha_usuario($fecha) {
		return date("d/m/Y", strtotime($fecha));
	}

}

?>