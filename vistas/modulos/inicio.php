
<?php

$item = null;
$valor = null;
$orden = "ventas";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$totalVentas = ControladorProductos::ctrMostrarSumaVentas();

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Tablero

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>
  <section class="content">
      <div class="row">
          <?php
          /*if($_SESSION["perfil"] == "Administrador"){
          include "inicio/cajas-superiores.php";
        }*/
          ?>
          <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-aqua">
                     <div class="inner">
                       <h3>$<?php echo number_format(10000,2); ?></h3>

                       <p>Total Domicilios</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-social-usd"></i>
                     </div>
                     <a href="reportes" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div>
                 <!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-green">
                     <div class="inner">
                       <h3><?php echo number_format(17000,2); ?></h3>

                       <p>Sub-Total Domiciolios</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-social-usd"></i>
                     </div>
                     <a href="reportes" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div>
                 <!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-yellow">
                     <div class="inner">
                       <h3><?php echo number_format(77); ?></h3>

                       <p>Clientes</p>
                     </div>
                     <div class="icon">
                       <i class="ion ion-person-add"></i>
                     </div>
                     <a href="clientes" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div>
                 <!-- ./col -->
                 <div class="col-lg-3 col-xs-6">
                   <!-- small box -->
                   <div class="small-box bg-red">
                     <div class="inner">
                       <h3><?php echo number_format(18); ?></h3>

                       <p>Domiciliarios</p>
                     </div>
                     <div class="icon">
                       <i class="fa fa-motorcycle"></i>
                     </div>
                     <a href="usuarios" class="small-box-footer">Mas informacion <i class="fa fa-arrow-circle-right"></i></a>
                   </div>
                 </div>

      </div>
      <div class="row">
          <div class="col-lg-6">
              <?php
              if($_SESSION["perfil"] == "Administrador"){
               include "reportes/grafico-ventas.php";
              }
              ?>
          </div>
          <div class="col-lg-6">
              <?php
              /*if($_SESSION["perfil"] == "Administrador"){
               include "reportes/productos-mas-vendidos.php";
             }*/
              ?>
              <div class="box box-default">

              	<div class="box-header with-border">

                    <h3 class="box-title">Mensajeros con mas Domicilios</h3>

                  </div>

              	<div class="box-body">

                    	<div class="row">

              	        <div class="col-md-7">

              	 			<div class="chart-responsive">

              	            	<canvas id="pieChart" height="150"></canvas>

              	          	</div>

              	        </div>

              		    <div class="col-md-5">

              		  	 	<ul class="chart-legend clearfix">

              		  	 	<?php

              					for($i = 0; $i < 10; $i++){

              					echo ' <li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> Nombre Domiciliarios</li>';

              					}


              		  	 	?>


              		  	 	</ul>

              		    </div>

              		</div>

                  </div>

                  <div class="box-footer no-padding">

              		<ul class="nav nav-pills nav-stacked">

              			 <?php

                        	for($i = 0; $i <5; $i++){

                        		echo '<li>

              						 <a>

              						 <img src="vistas/img/usuarios/admin/191.jpg" class="img-thumbnail" width="60px" style="margin-right:10px">
              						 Nombre del Domiciliario

              						 <span class="pull-right text-'.$colores[$i].'">
              						 '.ceil(10*100/10).'%
              						 </span>

              						 </a>

                    				</li>';

              			}

              			?>


              		</ul>

                  </div>

              </div>
          </div>
          <div class="col-lg-6">
              <?php
              if($_SESSION["perfil"] == "Administrador"){
               //include "inicio/productos-recientes.php";
              }
              ?>
          </div>

          <div class="col-lg-12">
              <?php
              if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){
                  echo '<div class="box box-success">
                      <div class="box-header">

                  <h1>Bienvenid@ ' .$_SESSION["nombre"].'</h1>
                      </div>
              </div>';

              }
              ?>
          </div>

      </div>


  </section>


</div>
<script>


  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [

  <?php

  for($i = 0; $i < 10; $i++){

  	echo "{
      value    : ".$productos[$i]["ventas"].",
      color    : '".$colores[$i]."',
      highlight: '".$colores[$i]."',
      label    : 'Nombre Domiciliario'
    },";

  }

   ?>
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------


</script>
