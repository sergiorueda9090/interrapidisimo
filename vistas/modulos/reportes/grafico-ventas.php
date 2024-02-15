<!--GRAFICO DE VENTAS-->
<?php

if(isset($_GET["fechaInicial"])){
  $fechaInicial = $_GET["fechaInicial"];
  $fechaFinal = $_GET["fechaFinal"];
  $respuesta = Reportes::ctrVentas($fechaInicial,$fechaFinal);
}else{
  $respuesta = Reportes::ctrVentas($fechaInicial,$fechaFinal);
}

$arrayFechas = array();
$arrayVentas = array();
$sumaPagoMes = array();

foreach($respuesta as $key => $value){
  #capturamos solo el año y el mes
  $fecha = substr($value["fecha"],0,7);
  #Introducimos las fechas en arrayFechas
  array_push($arrayFechas,$fecha);
  #Capturamos las ventas
  $arrayVentas = array($fecha => $value["precioDomicilio"]);
  #Sumamos los pagos que ocurrieron el mismo mes
  foreach ($arrayVentas as $key => $value) {
      $sumaPagoMes[$key] += $value;
  }

}

$noRepetirFechas = array_unique($arrayFechas);

?>

<div class="box box-solid bg-teal-gradient">

    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Grafico de domicilios</h3>
    </div>
    <div class="box-body border-radius-none nuevoGraficoVentas">
    <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
    </div>
</div>


<script>

var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
      <?php
        foreach ($noRepetirFechas as $key) {
              echo "  {y: '".$key."', Domicilio: ".$sumaPagoMes[$key]."},";
          }
              echo "{y: '".$key."', Domicilio:0}";
      ?>
    ],
    xkey             : 'y',
    ykeys            : ['Domicilio'],
    labels           : ['Domicilio'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });


</script>
