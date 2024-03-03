<style>
.loader {
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  animation: moveUpDown 1s ease-in-out infinite alternate;
  display:hide;
}

@keyframes moveUpDown {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-10px);
  }
}
</style>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

     Reportes Domiciliarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active"> Reportes Domiciliarios</li>

    </ol>

  </section>

  <section class="content">


    <div class="box">

      <div class="box-header with-border">


      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>
           <th style="width:10px">#</th>
           <th>Nombre Domiciliario</th>
           <th>Nombre Cliente</th>
           <th>Cliente</th>
           <th>Metodo de pago</th>
           <th>Direccion 1</th>
           <th>Direccion 2</th>
           <th>Direccion 3</th>
           <th>Proceso</th>
           <th>Valor domicilio</th>
           <th>Fecha</th>
           <th>Acciones</th>
         </tr>

        </thead>

        <tbody>

        <?php
        
        $id = null;

        $deliverys = ReportDeliveryCtr::ctrListReportsDeliverys($id);
    
       foreach ($deliverys as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["nombreCliente"].'</td>
                  <td>'.$value["cliente"].'</td>
                  <td>'.$value["selectPayMethod"].'</td>
                  <td>'.$value["pickupAddress"].'</td>
                  <td>'.$value["newAddress"].'</td>
                  <td>'.$value["destinationAddress"].'</td>
                  <td>'.$value["paymentProcess"].'</td>
                  <td>'.$value["deliveryPraci"].'</td>
                  <td>'.$value["dateCrate"].'</td>';
          echo '<td>

                    <div class="btn-group">  

                      <button class="btn btn-warning btnShowReportDelivery" idUsuario="'.$value["idUsuario"].'" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i></button>
                    </div>

                  </td>

                </tr>';
        }


        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Información del Mensajero</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Nombre del Mensajero:</strong> Juan Pérez</p>
        <p><strong>Placa de la Moto:</strong> ABC123</p>
        <h3 style="text-align:center;">Domicilios del Día</h3>
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
                <tr>
                    <th>N. Cliente</th>
                    <th>N. Domiciliario</th>
                    <th>Destino</th>
                    <th>Valor Domicilio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody class="infoTable" id="infoTable">
                <!-- Aquí se agregarían más filas según los domicilios del día -->
            </tbody>

        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--=====================================
END MODAL AGREGAR CLIENTE
======================================-->

<?php

  $borrarCliente = new DeliveryCTR();
  $borrarCliente -> ctrBorrarDelivery();

?>
<script src="vistas/js/reportDelivery.js"></script>