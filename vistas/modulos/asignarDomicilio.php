<style>

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Domicilios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Domicilios</li>

    </ol>

  </section>

  <section class="content">

    <div class="info-box" style=" border-top: 5px solid #4c6ef8;">

      <div class="box-header with-border">

        <!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#asignarModal">
            ASIGNAR DOMICILIARIO
        </button>-->

      </div>
      <br>

      <?php
          $item = null;
          $valor = null;
          $respuesta = ControladorMesa::ctrMostrarMesas($item,$valor);
          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

       ?>

      <!--=====================================
      ÚLTIMOS USUARIOS
      ======================================-->
      <div class="container-fluid">

        <div class="row">

          <?php
          $contador = 0;
          $cant = 1;
          foreach ($usuarios as $key => $value) {

            echo '<div class="col-sm-4 col-lg-4 col-12">


                   <div class="box box-success" style="-webkit-box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);
                                                       -moz-box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);
                                                        box-shadow: 1px 2px 9px -2px rgba(0,0,0,0.75);">


                     	<div class="box-header with-border">

                   	    <h3 class="box-title">Nombre: '.$value["nombre"].'</h3><br>
                        <h2 class="box-title">Placa: '.$value["placa"].'</h2><br>
                        <h2 class="box-title">Telefono: '.$value["telefonoUsuario"].'</h2>
                   	    <div class="box-tools pull-right">
                   	      <button type="button" class="btn btn-box-tool" data-widget="collapse">
                              <i class="fa fa-minus"></i>
                   	      </button>
                   	    </div>
                     	</div>

                     	<div class="box-body no-padding" style="overflow:scroll;height:200px;">
                         <div class="box-header with-border">
                           <div class="user-block">
                            <img class="img-circle" src="vistas/img/usuarios/default/anonymous.png" alt="User Image">

                             <span class="username"><a class="users-list-name" href="#">
                                  Domiciliario</a></span>
                                  <span class="description">'.$value["nombre"].'</span>
                              </div>
                         </div>
                          <ul style="padding: 3px 10px 0px 10px;" class="nav nav-pills nav-stacked">
                              <li>



                            <button class="btn btn-sm btn-success btnAgregarProducto" idItemMesero="'.$value["id"].'" idItemMesa="'.$value["idMesa"].'" idItemEstado="'.$value["estado"].'" data-toggle="modal" data-target="#modalAgragarProducto">
                                       <i class="fa fa-motorcycle" aria-hidden="true"></i>
                                     </button>
                                     <button class="btn btn-sm btn-danger btnEliminarOrden" id="'.$value["id"].'" idItemMesero="'.$value["id"].'" idItemMesa="'.$value["idMesa"].'" idItemEstado="'.$value["estado"].'">
                                       <i class="fa fa-times" aria-hidden="true"></i>
                                     </button>


                            </li>
                            </ul>
                         <ul class="nav nav-pills nav-stacked">

                         <table class="table table-striped table-hover">
                               <thead>
                                 <tr>
                                   <th scope="col">Cant</th>
                                   <th scope="col">Dirección</th>
                                   <th scope="col">Precio</th>
                                 </tr>
                               </thead>
                               <tbody>';

                               $respuestaD = DomicilioCtr::ctrMostrarDomicilios($value["id"]);

                               $valorTotalD = 0;
                               $valorSubTotal = 0;
                               if($respuestaD[0]["total"] == NULL){
                                    $valorTotalD = 0;
                                    $valorSubTotal = 0;
                               }else{
                                    $valorTotalD = $respuestaD[0]["total"];
                                    $valorSubTotal = $respuestaD[0]["subTotal"];
                               }

                               foreach ($respuestaD as $key => $valueD) {
                                 echo'<tr>
                                          <th scope="row">'.$cant++.'</th>
                                            <td> '.$valueD["direccion"].'
                                            </td>
                                          <td>$ '.number_format($valueD["precioDomicilio"]).'</td>
                                        </tr>';

                               }


                        echo'</tbody>
                                </table>
                                   </ul>



                        <div class="pull-right" style="padding:10px;">
                                    <span style="font-size:20px;"><strong>TOTAL</strong></span>
                                    <span style="font-size:20px;">$ '.number_format($valorTotalD).'</span>
                        </div>

                        <div class="pull-right" style="padding:10px;">
                                    <span style="font-size:20px;"><strong>COMISION</strong></span>
                                    <span style="font-size:20px;">$ '.number_format($valorSubTotal).'</span>
                        </div>


                     	</div>



                      <div class="box-footer text-center">
                         <button class="uppercase btn btn-success btn-block imprimirFactura" idU="'.$value["id"].'"><strong>PAGAR</strong></button>
                      </div>

                   </div>
                 </div>';
                 $contador++;

                 if($contador >= 3){
                   echo '<div class="clearfix "></div>';
                   $contador = 0;
                 }
                 $cant = 1;
               }
          ?>






     </div>
    </div>
      <!-- USERS LIST -->

    </div>

  </section>

</div>

  <?php
  $eliminarOrden = new AsignarMesa();
  $eliminarOrden -> ctrEliminarOrden();
  ?>

<!-- Modal -->
<div class="modal fade" id="asignarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header" style="background:#28A745; color:white">
        <h5 class="modal-title">AGREGAR DOMICILIARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form role="form" method="post">

          <div class="form-group">
            <label for="formGroupExampleInput">NOMBRE DOMICILIARIO</label>
            <select class="form-control" name="idPersonaAsignado">
              <option value="0">Seleccionar...</option>
              <?php
              foreach ($usuarios as $key => $persona) {
                   echo'<option value="'.$persona["id"].'">'.$persona["nombre"].'</optio>';
              }
               ?>
            </select>
          </div>

          <div class="form-group">
           <label for="exampleFormControlSelect1">AGREGAR DOMICILIARIO</label>
           <select class="form-control" name="idMesaAsignada">
             <option value="0">Seleccionar...</option>
             <?php
             foreach ($respuesta as $key => $mesas) {
                  echo'<option value="'.$mesas["id"].'">'.$mesas["nombre"].'</optio>';
             }
              ?>
           </select>
        </div>

        <!--<div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="checkReserva">
          <label class="form-check-label" for="exampleCheck1">Reservar</label>
        </div>-->

      <div class="reservaC" style="display:none">
        <div class="form-group">
          <label for="inputEmail4">Nombre cliente</label>
          <input type="text" name="nombreCliente" class="form-control nombreCliente">
        </div>
        <div class="form-group">
          <label for="inputPassword4">Numero cliente</label>
          <input type="text"  name="numeroCliente" class="form-control numeroCliente">
        </div>
        <div class="form-group">
          <label for="inputPassword4">Fecha reserva</label>
          <input type="datetime-local" name="fechaReserva" class="form-control fechaReserva">
        </div>
      </div>


       <?php
         $agregarAsignacion = new AsignarMesa();
         $agregarAsignacion -> ctrAsigarMesa();

       ?>

      </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
           <button type="submit" class="btn btn-success agregarAsignacion">Agregar</button>
         </div>

      </form>

    </div>
  </div>
</div>

<!-- Modal -->
<div id="modalAgragarProducto" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#28A745; color:white">

          <button type="button" class="close cerrarModalDomicilioX" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Domicilio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">


          <div class="form-row">

            <div class="form-group col-md-12">
              <label for="inputPassword4" style="font-size:18px;font-family:'Open Sans';">BUSCAR CLIENTE</label>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <select class="form-control select2 py-4" id="inputPais" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <?php
                  $item = null;
                  $valor = null;

                  $clientes = ClienteCtr::ctrMostrarClientes($item, $valor);
                    foreach ($clientes as $key => $value){
                      if($key == 0){
                        echo '<option class="seleccionarCliente" value="0">Seleccionar...</option>';
                      }else{
                          echo '<option class="seleccionarCliente" value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
                      }

                    }
                  ?>
              </select>
              </div>
          </div>

            <div class="form-group col-md-6">
              <label for="inputEmail4" style="font-size:18px;font-family:'Open Sans';">Teléfono Cliente</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="number" class="uppercase form-control telefonoCliente" style="font-size:23px;font-family:'Open Sans'">
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4" style="font-size:18px;font-family:'Open Sans';">Nombre Cliente</label>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="uppercase form-control nombreClientes" style="font-size:23px;font-family:'Open Sans'">
              </div>
            </div>

            <div class="form-group col-md-6">
                   <label for="inputState" style="font-size:18px;font-family:'Open Sans';">Zona</label>
            <?php

            echo'<div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                     <select class="form-control seleccionarPedidoDomi" style="font-size:20px;font-family:Open Sans;">
                           <option value="0">Seleccionar...</option>';
                    foreach ($respuesta as $key => $value) {
                   echo'<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';
          }

          echo'</select>
              </div>
            </div>';
            ?>

            <div class="form-group col-md-6">
              <label for="inputState" style="font-size:18px;font-family:'Open Sans';">Barrio</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                  <select class="form-control seleccionarBarrio uppercase" style="font-size:20px;font-family:'Open Sans';">
                    <option value="0">Seleccionar...</option>
                    <option value="Altos del Progreso">Altos del Progreso</option>
                    <option value="Altos del Kennedy">Altos del Kennedy</option>
                    <option value="Balcones del Kennedy (Sector Hamacas de la Curva)">Balcones del Kennedy (Sector Hamacas de la Curva)</option>
                    <option value="Betania">Betania</option>
                    <option value="Campestre Norte (Getsemaní, los cerros, la Fortuna)">Campestre Norte (Getsemaní, los cerros, la Fortuna)</option>
                    <option value="Claveriano">Claveriano</option>
                    <option value="Colorados">Colorados</option>
                    <option value="Colseguros Norte">Colseguros Norte</option>
                    <option value="El Pablón">El Pablón</option>
                    <option value="El Rosal">El Rosal</option>
                    <option value="Kennedy">Kennedy</option>
                    <option value="Las Hamacas">Las Hamacas</option>
                    <option value="Minuto de Dios">Minuto de Dios</option>
                    <option value="Miradores del Kennedy">Miradores del Kennedy</option>
                    <option value="María Paz">María Paz</option>
                    <option value="Miramar">Miramar</option>
                    <option value="Olas Altas">Olas Altas</option>
                    <option value="Olas Bajas">Olas Bajas</option>
                    <option value="Omagá 1">Omagá 1</option>
                    <option value="Omagá 2">Omagá 2</option>
                    <option value="Paisajes del Norte">Paisajes del Norte</option>
                    <option value="Rosalta">Rosalta</option>
                    <option value="San Valentín">San Valentín</option>
                    <option value="Tejar Norte">Tejar Norte</option>
                    <option value="Tejarcitos">Tejarcitos</option>
                    <option value="Villa Rosa">Villa Rosa</option>
                    <option value="Villa Alegría I">Villa Alegría I</option>
                    <option value="Villa Alegría II">Villa Alegría II</option>
                    <option value="Villa María I">Villa María I</option>
                    <option value="Villa María II">Villa María II</option>
                    <option value="Villa María III">Villa María III</option>
                    <option value="Villas de San Ignacio (Sectores Bavaria I, II, Betania I, II, Ingeser)">Villas de San Ignacio (Sectores Bavaria I, II, Betania I, II, Ingeser)</option>
                    <option value="Portal de los Ángeles (ASOVIPORAN)">Portal de los Ángeles (ASOVIPORAN)</option>
                    <option value="13 de junio">13 de junio</option>
                    <option value="Bosconia">Bosconia</option>
                    <option value="Bosque norte">Bosque norte</option>
                    <option value="El Plan">El Plan</option>
                    <option value="Esperanza I">Esperanza I</option>
                    <option value="Esperanza II">Esperanza II</option>
                    <option value="Esperanza III">Esperanza III</option>
                    <option value="LA independencia">LA independencia</option>
                    <option value="La Juventud">La Juventud</option>
                    <option value="Lizcano I">Lizcano I</option>
                    <option value="Lizcano II">Lizcano II</option>
                    <option value="Los Ángeles">Los Ángeles</option>
                    <option value="Nueva Colombia">Nueva Colombia</option>
                    <option value="Olas II">Olas II</option>
                    <option value="Regadero Norte">Regadero Norte</option>
                    <option value="San Cristóbal">San Cristóbal</option>
                    <option value="Transición">Transición</option>
                    <option value="Villa Helena I">Villa Helena I</option>
                    <option value="Villa Helena II">Villa Helena II</option>
                    <option value="Villa Mercedes">Villa Mercedes</option>
                    <option value="Alarcón">Alarcón</option>
                    <option value="Chapinero">Chapinero</option>
                    <option value="Cinal">Cinal</option>
                    <option value="Comuneros">Comuneros</option>
                    <option value="Modelo">Modelo</option>
                    <option value="Mutualidad">Mutualidad</option>
                    <option value="San Francisco">San Francisco</option>
                    <option value="San Rafael">San Rafael</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Universidad">Universidad</option>
                    <option value="12 de Octubre">12 de Octubre</option>
                    <option value="23 de junio">23 de junio</option>
                    <option value="Don Bosco">Don Bosco</option>
                    <option value="Gaitán">Gaitán</option>
                    <option value="Girardot">Girardot</option>
                    <option value="Granada">Granada</option>
                    <option value="La Feria">La Feria</option>
                    <option value="La Gloria">La Gloria</option>
                    <option value="Napoles">Nápoles</option>
                    <option value="Narino">Nariño</option>
                    <option value="Pío XII">Pío XII</option>
                    <option value="Santander">Santander</option>
                    <option value="Río de Oro I">Río de Oro I</option>
                    <option value="Primero de mayo">Primero de mayo</option>
                    <option value="Alfonso López">Alfonso López</option>
                    <option value="Campo Hermoso">Campo Hermoso</option>
                    <option value="Charta">Charta</option>
                    <option value="Chorreras Don Juan">Chorreras Don Juan</option>
                    <option value="La Estrella">La Estrella</option>
                    <option value="La Joya">La Joya</option>
                    <option value="Quinta Estrella">Quinta Estrella</option>
                    <option value="Pantano I">Pantano I</option>
                    <option value="Pantano II">Pantano II</option>
                    <option value="Pantano III">Pantano III</option>
                    <option value="Rincón de Paz (17 de enero y 12 de febrero)">Rincón de Paz (17 de enero y 12 de febrero)</option>
                    <option value="Río de Oro II">Río de Oro II</option>
                    <option value="Candiles">Candiles</option>
                    <option value="Gómez Niño">Gómez Niño</option>
                    <option value="La Ceiba">La Ceiba</option>
                    <option value="La Concordia">La Concordia</option>
                  </select>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4" style="font-size:18px;font-family:'Open Sans';">Dirección Cliente</label>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-home"></i></span>
                  <textarea type="text" rows="4" class="uppercase form-control direccionCliente" style="font-size:23px;font-family:'Open Sans';"></textarea>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="inputPassword4" style="font-size:18px;font-family:'Open Sans';">Dirección Destino</label>
              <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-home"></i></span>
                 <textarea type="text" rows="4" class="uppercase form-control direccionDestino" style="font-size:23px;font-family:'Open Sans';"></textarea>
              </div>
            </div>

              <div class="form-group col-md-6">
                <label for="inputState" style="font-size:18px;font-family:'Open Sans';">Forma de pago</label>
                 <div class="input-group" style="font-size:23px;font-family:'Open Sans';">
                   <span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
                     <select class="form-control selectFormaPago uppercase" style="font-size:20px;font-family:'Open Sans';">
                         <option value="0" style="font-size:23px;font-family:'Open Sans';">Seleccionar...</option>
                         <option value="Contado" style="font-size:23px;font-family:'Open Sans';">Contado</option>
                         <option value="Credito" style="font-size:23px;font-family:'Open Sans';">Credito</option>
                      </select>
                  </div>
              </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4" style="font-size:18px;font-family:'Open Sans';">Precio</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                <input type="number" class="form-control precioDomicilio uppercase" value="0" id="precioDomicilio" style="font-size:23px;font-family:'Open Sans';">
                <input type="hidden" class="form-control precioDomicilioOculto" id="precioDomicilioOculto">
              </div>
            </div>

            <div class="form-group col-md-2">
              <label for="inputPassword4" style="font-size:18px; font-family:'Open Sans';">Porcentaje %</label>
              <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  <input type="number" class="form-control PorcentajeDomicilio uppercase" id="PorcentajeDomicilio" value="30" disabled style="font-size:23px;font-family:'Open Sans';">
              </div>
            </div>

            <div class="form-group col-md-12">
              <br>
              <button class="btn btn-success btn-block btnAgregarDomicilio" disabled type="button">Agregar Domicilio</button>
            </div>

            <table class="table table-striped">
  <thead>
    <tr style="font-size:13px;">
      <th scope="col">Teléfono</th>
      <th scope="col">Nombre</th>
      <th scope="col">Dirección Cliente</th>
      <th scope="col">Dirección Destino</th>
      <th scope="col">Zona</th>
      <th scope="col">Barrio</th>
      <th scope="col">Precio</th>
      <th scope="col">______Acciones______</th>
    </tr>
  </thead>
  <tbody id="tablaDomicilios" style="font-size:20px;">

  </tbody>
</table>



    <div class="pull-right" style="padding:10px;">
        <span style="font-size:25px;"><strong>TOTAL</strong></span>
        <span style="font-size:30px;" id="totalDomicilio"></span>
    </div>

          </div>

          </div>

        </div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left cerrarModalDomicilio" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-success guardarDomicilio">Guardar domicilio</button>
          <button type="button" style="display:none;" class="btn btn-success editarDomicilio">Editar domicilio</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php
$eliminarDomicilio = new DomicilioCtr();
$eliminarDomicilio -> ctrEliminarDomicilio();
?>
