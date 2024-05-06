<?php

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("libs/fpdf.php");

class PDF extends FPDF {

    function Header() {
        $this->SetFont('Arial','B',12);
        $this->Cell(50,10,'Listado de Empleados',0,0,'C');
        $this->Cell(263,10, utf8_decode('Hoja Nº ') . $this->PageNo() , 0,1,'C');
        $this->Ln(10);
    }

    function Footer() {
    }

}

?>