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

      Administrar Delivery

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Delivery</li>

    </ol>

  </section>

  <section class="content">


    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-new-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar Delivery

        </button>

      </div>

      <div class="box-body">
        <?php

            $customer     = DeliveryCTR::crtListCustomer();
            $domiciliarys = DeliveryCTR::crtListDomiciliary();        
        ?>

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Telefono</th>
           <th>Mensajero</th>
           <th>Tipo</th>
           <th>Modo de pago</th>
           <th>Datos de recogida</th>
           <th>Datos de destino</th>
           <th>Nota</th>
           <th>Precio domicilio</th>
           <th>Proceso de pago</th>
           <th>Usuario</th>
           <th>Fecha</th>
           <th>Acciones</th>
         </tr>

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $deliverys = DeliveryCTR::ctrListDeliverys($item, $valor);
      

       foreach ($deliverys as $key => $value){

          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["telefono1"].'</td>
                  <td>'.$value["nombreDomiciliario"].'</td>
                  <td>'.$value["type"].'</td>
                  <td>'.$value["typeOfPay"].'</td>
                  <td>'.$value["pickupAddress"].'</td>
                  <td>'.$value["destinationAddress"].'</td>
                  <td>'.$value["note"].'</td>
                  <td>'.$value["deliveryPraci"].'</td>';
                  if($value["paymentProcess"] == "enproceso"){
                    echo "<td>En proceso</td>";
                  }else{
                    echo '<td>'.$value['paymentProcess'].'</td>';
                  }
                  echo '<td>'.$value["userCreate"].'</td>
                        <td>'.$value["dateCrate"].'</td>'
                  ;
          echo '<td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarDelivery" iddelivery="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarDelivery"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarDelivery" iddelivery="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#4c6ef8; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Delivery</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <!-- ENTRADA PARA EL CLIENTE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="customers" class="form-label">Selecciona el cliente:</label>
                  <select class="custom-select customers form-control input-lg" name="customerName" id="customers" required>
                    <option value="">Selecciona el cliente</option>
                    <?php
                      foreach($customer as $key => $values){
                        echo '<option  value="'.$values['id'].'">'.$values['cliente'].'</option>';
                      }
                    ?>
                  </select>

                  </div>
                </div>
              </div>

               <!-- ENTRADA PARA EL MENSAJERO -->
               <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">Selecciona el Mensajero:</label>
                  <select class="custom-select browser form-control input-lg browser"  name="browser" id="browser" required>
                    <option value="">Selecciona el Mensajero</option>
                    <?php
                      foreach($domiciliarys as $key => $values){
                        echo '<option  value="'.$values['id'].'">'.$values['nombre'].'</option>';
                      }
                    ?>
                  </select>
                  </div>
                </div>
              </div>

              <!-- NAME CUSTOMER -->
              <!--<div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-lg nameCliente" name="nameCliente" placeholder="Nombre Cliente" readonly>
                  </div>
                </div>
              </div>-->
                
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg nameCliente" name="nameCliente" id="nameCliente" readonly>
                      <option value="">Sin Usuarios</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 1-->
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoCliente1" name="telefonoCliente1" placeholder="Ingresar Telefono 1" readonly>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 2-->
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoCliente2" name="telefonoCliente2" placeholder="Ingresar Telefono 2" readonly>
                  </div>
                </div>
              </div>

              <!-- ENTRADA CREDITO O CONTADO-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg tipo" name="tipo"  readonly>
                      <option value="">TIPO</option>
                      <option value="CREDITO">Credito</option>
                      <option value="CONTADO">Contado</option>
                    </select>
                  </div>
                </div>
              </div>

            <!-- ENTRADA METODO DE PAGO-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg tipoPagar" name="tipoPagar" required>
                      <option value="">Metodo de pago</option>
                      <option value="CREDITO">Credito</option>
                      <option value="CONTADO">Contado</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <!-- SELECT PAY METHOD-->
              <div class="col-lg-6 pull-right selectPayMethod" style="display:none;">
                  <input type="radio" id="r_efectivo" name="r_selectPayMethod" value="Efectivo" class="r_efectivo">
                  <label for="r_efectivo">Efectivo</label>
                 
                  <input type="radio" id="r_yoppy" name="r_selectPayMethod" value="Yoppy" class="r_yoppy">
                  <label for="r_yoppy">Yappy</label>

                  <input type="radio" id="r_transferencia" name="r_selectPayMethod" value="Transferencia" class="r_transferencia">
                  <label for="r_transferencia">Transferencia</label>
                  
                  <input type="radio" id="r_pendiente" name="r_selectPayMethod" value="Pendiente" class="r_pendiente">
                  <label for="r_pendiente">Pendiente</label>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Direccion Cliente:</label>
                 <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionCliente" name="direccionCliente" placeholder="Ingresar Direccion" required readonly></textarea>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Datos de Recogida:</label>
                 <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionNew" name="direccionNew" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

            <!-- ENTRADA PARA LA DIREECION DESTINO-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Datos de destino:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionDestino" name="direccionDestino" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

              <!-- NOTA -->
              <div class="col-lg-12">            
                <div class="form-group">
                <label for="browser" class="form-label">Nota:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control nota" name="nota" placeholder="Nota"></textarea>
                  </div>
                </div>
              </div>

              <!-- VALOR DOMICILIO -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">Valor Delivery:</label>
                    <input type="text" class="form-control input-lg valorDomicilio" name="valorDomicilio" placeholder="Valor domicilio" required>
                  </div>
                </div>
              </div>


              <!-- MONEY -->
              <div class="col-lg-3">
              <label>Estado actual del dinero:</label><br>
                
                  <input type="radio" id="enproceso" name="estado" value="enproceso" class="enproceso">
                  <label for="enproceso">En Proceso</label>
                  <br>

                  <input type="radio" id="pagado" name="estado" value="pagado" class="pagado">
                  <label for="pagado">Pagado</label>
                  <br>

                  <input type="radio" id="admin_recibe_dinero" name="estado" value="admin_recibe_dinero" class="admin_recibe_dinero">
                  <label for="admin_recibe_dinero">En Caja</label>
                
              </div>

              <!-- USERCREATE -->
              <div class="col-lg-3">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">USERCREATE: <?php echo $_SESSION["nombre"] ?></label>
                    <input type="hidden" class="form-control input-lg idUser" name="idUser" value="<?php echo $_SESSION["id"]?>">
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-new-primary btn-block">GUARDAR DELIVERY</button>

        </div>

        <?php

          $crearDelivery = new DeliveryCTR();
          $crearDelivery -> ctrCreateDelivery();

        ?>

      </form>

    </div>

  </div>

</div>
<!--=====================================
END MODAL AGREGAR CLIENTE
======================================-->

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->
<div id="modalEditarDelivery" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#4c6ef8; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Delivery</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <!-- ENTRADA PARA EL CLIENTE -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">Selecciona el cliente:</label>
                  <select class="custom-select customers form-control input-lg customerNameEditar" name="customerNameEditar" required disabled>
                    <option selected>Selecciona el cliente</option>
                    <?php
                      foreach($customer as $key => $values){
                        echo '<option  value="'.$values['id'].'">'.$values['cliente'].'</option>';
                      }
                    ?>
                  </select>

                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL MENSAJERO -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">Selecciona el Mensajero:</label>
                  <select class="custom-select browser form-control input-lg browserEditar"  name="browserEditar" id="browserEditar" required>
                    <option selected>Selecciona el Mensajero</option>
                    <?php
                      foreach($domiciliarys as $key => $values){
                        echo '<option  value="'.$values['id'].'">'.$values['nombre'].'</option>';
                      }
                    ?>
                  </select>
                  </div>
                </div>
              </div>

              <!-- NAME CUSTOMER -->
              <!--<div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg nameClienteEditar" name="nameClienteEditar" placeholder="Nombre Cliente" readonly>
                  </div>
                </div>
              </div>-->
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg nameClienteEditar" name="nameClienteEditar" id="nameClienteEditar" readonly>
                      <option value="">Sin Usuarios</option>
                    </select>
                  </div>
                </div>
              </div>


              <!-- ENTRADA PARA EL TELEFONO 1-->
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoCliente1Editar" name="telefonoCliente1Editar" placeholder="Ingresar Telefono 1" readonly>
                    <input type="hidden" class="form-control input-lg idDeliveryEditar" name="idDeliveryEditar">
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA EL TELEFONO 2-->
              <div class="col-lg-4">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                    <input type="text" class="form-control input-lg telefonoCliente2Editar" name="telefonoCliente2Editar" placeholder="Ingresar Telefono 2" readonly>
                  </div>
                </div>
              </div>

              <!-- ENTRADA CREDITO O CONTADO-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg tipoEditar" name="tipoEditar" readonly>
                      <option value="">Tipo</option>
                      <option value="CREDITO">Credito</option>
                      <option value="CONTADO">Contado</option>
                    </select>
                  </div>
                </div>
              </div>

            <!-- ENTRADA METODO DE PAGO-->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control input-lg tipoPagarEditar" name="tipoPagarEditar" required>
                      <option value="">Metodo de pago</option>
                      <option value="CREDITO">Credito</option>
                      <option value="CONTADO">Contado</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- SELECT PAY METHOD-->
              <div class="col-lg-6 pull-right selectPayMethodEditar" style="display:none;">
                  <input type="radio" id="r_efectivoEditar" name="r_selectPayMethodEditar" value="efectivo" class="r_efectivo">
                  <label for="r_efectivo">Efectivo</label>
                 
                  <input type="radio" id="r_yoppyEditar" name="r_selectPayMethodEditar" value="Yoppy" class="r_yoppyEditar">
                  <label for="r_yoppyEditar">Yappy</label>
                    
                  <input type="radio" id="r_transferenciaEditar" name="r_selectPayMethodEditar" value="Transferencia" class="r_transferenciaEditar">
                  <label for="r_transferenciaEditar">Transferencia</label>

                  <input type="radio" id="r_pendienteEditar" name="r_selectPayMethodEditar" value="Pendiente" class="r_pendienteEditar">
                  <label for="r_pendienteEditar">Pendiente</label>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Direccion Cliente:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionClienteEditar" name="direccionClienteEditar" placeholder="Ingresar Direccion" required readonly></textarea>
                  </div>
                </div>
              </div>

              <!-- ENTRADA PARA LA DIREECION-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Datos de recogida :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control newDireccionEditar" name="newDireccionEditar" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

            <!-- ENTRADA PARA LA DIREECION DESTINO-->
              <div class="col-lg-4">            
                <div class="form-group">
                <label for="browser" class="form-label">Datos de destino:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control direccionDestinoEditar" name="direccionDestinoEditar" placeholder="Ingresar Direccion" required></textarea>
                  </div>
                </div>
              </div>

              <!-- NOTA -->
              <div class="col-lg-12">            
                <div class="form-group">
                <label for="browser" class="form-label">Agregar Nota:</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <textarea  type="text" rows="4" class="form-control notaEditar" name="notaEditar" placeholder="Nota"></textarea>
                  </div>
                </div>
              </div>

              <!-- VALOR DOMICILIO -->
              <div class="col-lg-6">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">Valor delivery:</label>
                    <input type="text" class="form-control input-lg valorDomicilioEditar" name="valorDomicilioEditar" placeholder="Valor domicilio" required>
                  </div>
                </div>
              </div>


              <!-- MONEY -->
              <div class="col-lg-3">
              <label>Estado actual del dinero:</label><br>
                
                  <input type="radio" class="editStatusMoney" id="enprocesoEditar" name="estadoEditar" value="enproceso">
                  <label for="enproceso">En Proceso</label>
                  <br>

                  <input type="radio" id="pagadoEditar" class="editStatusMoney" name="estadoEditar" value="pagado">
                  <label for="pagado">Pagado</label>
                  <br>

                  <input type="radio" id="admin_recibe_dineroEditar" class="editStatusMoney" name="estadoEditar" value="admin_recibe_dinero">
                  <label for="admin_recibe_dinero">Adm Recibe Dinero</label>
                
              </div>

              <!-- USERCREATE -->
              <div class="col-lg-3">
                <div class="form-group">
                  <div class="input-group">
                  <label for="browser" class="form-label">USERCREATE: <?php echo $_SESSION["nombre"] ?></label>
                    <input type="hidden" class="form-control input-lg idUserEditar" name="idUserEditar" value="<?php echo $_SESSION["id"]?>">
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-new-primary btn-block">EDITAR DELIVERY</button>

        </div>

        <?php

          $crearDelivery = new DeliveryCTR();
          $crearDelivery -> ctrEditarDelivery();

        ?>

      </form>

    </div>

  </div>

</div>
<!--=====================================
END MODAL EDITAR CLIENTE
======================================-->

<?php

  $borrarCliente = new DeliveryCTR();
  $borrarCliente -> ctrBorrarDelivery();

?>
<script src="vistas/js/delivery.js"></script>