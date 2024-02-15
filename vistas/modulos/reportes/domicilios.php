<?php

$fechaInicial = $_GET["fechaInicial"];
$fechaFinal = $_GET["fechaFinal"];

$respuesta = Reportes::ctrTotalDomicilios($fechaInicial,$fechaFinal);

?>

<!--VENDEDORES-->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Domicilios</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart2" style="height: 300px;"></div>
        </div>
    </div>
</div>
<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [
  <?php
  foreach ($respuesta as $key => $value) {
    echo "{y: '".$value["nombre"]."', a: '".$value["totalDomicilios"]."'},";
  }
  ?>
  ],
  barColors: ['#FFC107'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});

</script>
