<?php  

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Conexion.php");
include_once("functions/Helper.php");

$helper = new Helper();

?>

<div class="card card-primary contenedor">
<div class="card-header bg-primary">Reporte</div>
  <div class="card-body">

<?php

$conexion = new Conexion();
$conexion->abrir_conexion();
$conn = $conexion->retornar_conexion();

$sql = $conn->prepare('SELECT COUNT(e.id_estado_civil) AS cantidad, ec.nombre FROM empleados e JOIN estados_civiles ec ON e.id_estado_civil = ec.id GROUP BY ec.nombre');
$sql->execute();

$resultado = $sql->fetchAll();

$titulo    = "Reporte de estados civiles de empleados";

$ids        = array();
$textos       = array();
$datos = array();

foreach ($resultado as $fila) {
    $nombre = $fila['nombre'];
    $cantidad = $fila['cantidad'];
    array_push($textos,$nombre);
    array_push($datos,$cantidad);
}

$nombres = array();
$series  = array();

for ($i = 0; $i <= count($textos) - 1; $i++) {
    
    $nombre = $textos[$i];
    $valor  = $datos[$i];
    $serie  = array(
        'name' => $nombre,
        'y' => (int) $valor
    );
    array_push($nombres, $nombre);
    array_push($series, $serie);
}

$conexion->cerrar_conexion();
                     
?> 

<script type="text/javascript">
$(function () {
    $('#grafico1').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: '<?php echo $titulo; ?>'
        },
        xAxis: {
            categories: <?php echo json_encode($nombres); ?>,
            title: {
            text: 'Empleados'
            }
        },
                
        yAxis: {
            min: 0,
            title: {
                text: 'Estados civiles',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
        useHTML: true,
        formatter: function() {
            return 'Cantidad : '+this.point.y;
        }},
        plotOptions: {
        
        series: {
            dataLabels:{
                //enabled:true,
            },events: {
                legendItemClick: function () {
                        return false; 
                }
            }
        }
          },
        legend: {
            reversed: true
        },
        credits: {
            enabled: false
        },
        series: [{
        name:'Estados civiles',
        data: <?php
            echo json_encode($series);
?>
 }]
    });
});
</script>    

<div id="grafico1"></div>

</div>
</div>