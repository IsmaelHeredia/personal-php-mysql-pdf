<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("data/empleadoDatos.php");
include_once("functions/Helper.php");
include_once("forms/exportar/plantilla.php");

$helper = new Helper();

$empleadoDatos = new EmpleadoDatos();

$dni = "";

if(isset($_GET["buscar"]) && is_numeric($_GET["buscar"])) {
	$dni = $_GET["buscar"];
}

$empleados = $empleadoDatos->Listar($dni);

$pdf = new PDF("P","mm","letter");
$pdf->SetTitle("Reporte");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(10,10,10);
$pdf->SetFont("Arial","B", 9);

$pdf->Cell(20,5,"DNI",1,0,"C");
$pdf->Cell(60,5,"Apellidos y Nombres",1,0,"C");
$pdf->Cell(40,5,"Fecha de Nacimiento",1,0,"C");
$pdf->Cell(20,5,"Estado Civil",1,0,"C");
$pdf->Cell(10,5,"Sexo",1,0,"C");
$pdf->Cell(50,5,"Localidad",1,1,"C");

foreach($empleados as $empleado) {
	$id = $empleado->getId();
	$dni = $empleado->getDni();
	$apellidos_nombres = utf8_decode($empleado->getApellidosNombres());
	$fecha_nacimiento = $helper->convertir_fecha_usuario($empleado->getFechaNacimiento());
	$estado_civil = $empleado->getEstadoCivil()->getNombre();
	$sexo = $empleado->getSexo();
	$localidad = utf8_decode($empleado->getLocalidad());
	$pdf->Cell(20,5, $dni, 1, 0, "C");
	$pdf->Cell(60,5, $apellidos_nombres, 1, 0, "C");
	$pdf->Cell(40,5, $fecha_nacimiento, 1, 0, "C");
	$pdf->Cell(20,5, $estado_civil, 1, 0, "C");
	$pdf->Cell(10,5, $sexo, 1, 0, "C");
	$pdf->Cell(50,5, $localidad, 1, 1, "C");
}

$pdf->Output();