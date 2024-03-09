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

     Reportes Mensajeros

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active"> Reportes Mensajeros</li>

    </ol>

  </section>

  <section class="content">


    <div class="box">

      <div class="box-header with-border">


      </div>

      <div class="box-body">

      <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="fechaInicioInput">Fecha de inicio</label>
                <input type="date" id="fechaInicioInput" class="fechaInput form-control" placeholder="Fecha de inicio">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label for="fechaFinInput">Fecha de fin</label>
                <input type="date" id="fechaFinInput" class="fechaInput form-control" placeholder="Fecha de fin">
            </div>
        </div>

        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out 1</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Check me out 2</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck3">
                        <label class="form-check-label" for="exampleCheck3">Check me out 3</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
        <button type="button" class="btn btn-primary btn-block">Filtrar</button>
        </div>


    </div>
        <br>


       <table class="table table-bordered table-striped dt-responsive tablas mt-4" width="100%">

        <thead>

         <tr>
           <th style="width:10px">#</th>
           <th>Mensajero</th>
           <th>Cliente</th>
           <th>Usuario</th>
           <th>Tipo de pago</th>
           <th>Metodo de pago</th>
           <th>Estado del dinero</th>
           <th>Nota</th>
           <th>Valor</th>
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
                  <td>'.$value["type"].'</td>
                  <td>'.$value["selectPayMethod"].'</td>
                  <td>'.$value["paymentProcess"].'</td>
                  <td>'.$value["note"].'</td>
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
                    <th>Cliente</th>
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