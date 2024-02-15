<?php

$fechaInicial = $_GET["fechaInicial"];
$fechaFinal = $_GET["fechaFinal"];

$respuesta = Reportes::ctrTotalVendedores($fechaInicial,$fechaFinal);

?>

<!--VENDEDORES-->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Domicilios</h3>
    </div>
    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart1" style="height: 300px;"></div>
        </div>
    </div>
</div>
<script>

//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [
  <?php
  foreach ($respuesta as $key => $value) {
    echo "{y: '".$value["nombre"]."', a: '".$value["total"]."'},";
  }
  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Domicilio'],
  preUnits: '$',
  hideHover: 'auto'
});

</script>
